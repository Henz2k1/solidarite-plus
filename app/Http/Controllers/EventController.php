<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class EventController extends Controller
{
    /**
     * Liste des événements.
     */
    public function index(Request $request)
    {
        // Requête AJAX : données destinées à DataTables
        if ($request->ajax()) {

            $events = Event::query()
                ->withCount('images')
                ->latest();

            return DataTables::of($events)

                ->addColumn('checkbox', function ($row) {
                    return '<div class="form-check font-16 mb-0">
                    <input class="form-check-input check-row"
                        name="single-row"
                        value="'.$row->id.'"
                        type="checkbox"
                        id="eventlist'.$row->id.'">
                    <label class="form-check-input-label"
                        for="eventlist'.$row->id.'">&nbsp;</label>
                </div>';
                })

                ->editColumn('title', function ($row) {
                    return '<span class="fw-bold">'.e($row->title).'</span>';
                })

                ->editColumn('location', function ($row) {
                    return e($row->location ?? 'Non renseigné');
                })

                ->editColumn('start_date', function ($row) {
                    return $row->start_date?->format('d/m/Y H:i');
                })

                ->addColumn('gallery_count', function ($row) {
                    return $row->images_count;
                })

                ->editColumn('status', function ($row) {
                    $statuses = [
                        'draft' => ['Brouillon', 'secondary'],
                        'published' => ['Publié', 'success'],
                        'archived' => ['Archivé', 'warning'],
                    ];

                    [$label, $color] = $statuses[$row->status]
                        ?? [$row->status, 'secondary'];

                    return '<span class="badge bg-'.$color.'">'
                        .e($label).
                    '</span>';
                })

                ->addColumn('action', function ($row) {
                    $editUrl = route('events.edit', $row->id);
                    $deleteUrl = route('events.destroy', $row->id);

                    return '
                <div class="btn-group">
                    <a href="'.$editUrl.'"
                        class="action-icon text-primary"
                        title="Modifier">
                        <i class="mdi mdi-square-edit-outline font-18"></i>
                    </a>

                    <a href="javascript:void(0);"
                        data-url="'.$deleteUrl.'"
                        class="action-icon text-danger delete-btn"
                        title="Supprimer">
                        <i class="mdi mdi-delete font-18"></i>
                    </a>
                </div>';
                })

                ->rawColumns([
                    'checkbox',
                    'title',
                    'status',
                    'action',
                ])

                ->make(true);
        }

        // Statistiques affichées sur la page

            $stats = [
                'total' => Event::count(),
                'published' => Event::where('status', 'published')->count(),
                'draft' => Event::where('status', 'draft')->count(),
            ];


        return view('admin.pages.events.index', compact('stats'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        return view('admin.pages.events.create');
    }

    /**
     * Enregistrement d'un événement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
            ],
            'location' => [
                'nullable',
                'string',
                'max:255',
            ],
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],
            'status' => [
                'required',
                Rule::in(['draft', 'published', 'archived']),
            ],
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],
            'gallery_images' => [
                'nullable',
                'array',
            ],
            'gallery_images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],
            'captions' => [
                'nullable',
                'array',
            ],
            'captions.*' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        $coverPath = $request->file('image')->store(
            'events/covers',
            'public'
        );

        try {
            $event = DB::transaction(function () use (
                $validated,
                $request,
                $coverPath
            ) {
                $event = Event::create([
                    'title' => $validated['title'],
                    'slug' => $this->generateUniqueSlug(
                        $validated['title']
                    ),
                    'description' => $validated['description'],
                    'image' => $coverPath,
                    'location' => $validated['location'] ?? null,
                    'start_date' => $validated['start_date'],
                    'end_date' => $validated['end_date'] ?? null,
                    'status' => $validated['status'],
                    'published_at' => $validated['status'] === 'published'
                        ? now()
                        : null,
                ]);

                // Enregistrement des images de la galerie
                if ($request->hasFile('gallery_images')) {
                    foreach ($request->file('gallery_images') as $index => $image) {
                        $path = $image->store(
                            'events/gallery',
                            'public'
                        );

                        $event->images()->create([
                            'image' => $path,
                            'caption' => $request->input(
                                "captions.$index"
                            ),
                            'sort_order' => $index,
                        ]);
                    }
                }

                return $event;
            });
        } catch (\Throwable $e) {
            Storage::disk('public')->delete($coverPath);

            throw $e;
        }

        return response()->json([
            'status' => true,
            'message' => 'Événement créé avec succès.',
            'data' => $event->load('images'),
        ]);
    }

    /**
     * Récupération d'un événement pour modification.
     */
    public function edit(Event $event)
    {
        $event->load('images');

        return view('admin.pages.events.edit', compact('event'));
    }

    /**
     * Mise à jour d'un événement.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
            ],
            'location' => [
                'nullable',
                'string',
                'max:255',
            ],
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],
            'status' => [
                'required',
                Rule::in(['draft', 'published', 'archived']),
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],
            'gallery_images' => [
                'nullable',
                'array',
            ],
            'gallery_images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],
            'captions' => [
                'nullable',
                'array',
            ],
            'captions.*' => [
                'nullable',
                'string',
                'max:255',
            ],
            'remove_images' => [
                'nullable',
                'array',
            ],
            'remove_images.*' => [
                'integer',
                'distinct',
                'exists:event_images,id',
            ],
        ]);

        // Vérifier que les images à supprimer appartiennent à cet événement
        $imagesToRemove = collect($validated['remove_images'] ?? []);

        if ($imagesToRemove->isNotEmpty()) {
            $ownedImages = $event->images()
                ->whereIn('id', $imagesToRemove)
                ->count();

            if ($ownedImages !== $imagesToRemove->count()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Certaines images ne sont pas associées à cet événement.',
                ], 422);
            }
        }

        $oldCover = $event->image;
        $newCover = null;

        if ($request->hasFile('image')) {
            $newCover = $request->file('image')->store(
                'events/covers',
                'public'
            );
        }

        $newGalleryPaths = [];

        try {
            DB::transaction(function () use (
                $event,
                $validated,
                $request,
                $newCover,
                &$newGalleryPaths
            ) {
                $event->update([
                    'title' => $validated['title'],
                    'slug' => $this->generateUniqueSlug(
                        $validated['title'],
                        $event->id
                    ),
                    'description' => $validated['description'],
                    'image' => $newCover ?? $event->image,
                    'location' => $validated['location'] ?? null,
                    'start_date' => $validated['start_date'],
                    'end_date' => $validated['end_date'] ?? null,
                    'status' => $validated['status'],
                    'published_at' => $validated['status'] === 'published'
                        ? ($event->published_at ?? now())
                        : null,
                ]);

                // Supprimer les anciennes photos sélectionnées
                if (! empty($validated['remove_images'])) {
                    $images = $event->images()
                        ->whereIn('id', $validated['remove_images'])
                        ->get();

                    foreach ($images as $image) {
                        Storage::disk('public')->delete($image->image);
                        $image->delete();
                    }
                }

                // Ajouter de nouvelles photos à la galerie
                if ($request->hasFile('gallery_images')) {
                    $lastOrder = (int) $event->images()
                        ->max('sort_order');

                    foreach ($request->file('gallery_images') as $index => $image) {
                        $path = $image->store(
                            'events/gallery',
                            'public'
                        );

                        $newGalleryPaths[] = $path;

                        $event->images()->create([
                            'image' => $path,
                            'caption' => $request->input(
                                "captions.$index"
                            ),
                            'sort_order' => $lastOrder + $index + 1,
                        ]);
                    }
                }
            });
        } catch (\Throwable $e) {
            if ($newCover) {
                Storage::disk('public')->delete($newCover);
            }

            Storage::disk('public')->delete($newGalleryPaths);

            throw $e;
        }

        // Supprimer l'ancienne couverture après remplacement
        if ($newCover && $oldCover) {
            Storage::disk('public')->delete($oldCover);
        }

        return response()->json([
            'status' => true,
            'message' => 'Événement mis à jour avec succès.',
            'data' => $event->fresh()->load('images'),
        ]);
    }

    /**
     * Suppression d'un événement.
     */
    public function destroy(Event $event)
    {
        $cover = $event->image;
        $gallery = $event->images()->get();

        DB::transaction(function () use ($event) {
            $event->images()->delete();
            $event->delete();
        });

        // Supprimer les fichiers physiques
        if ($cover) {
            Storage::disk('public')->delete($cover);
        }

        foreach ($gallery as $image) {
            Storage::disk('public')->delete($image->image);
        }

        return response()->json([
            'status' => true,
            'message' => 'Événement supprimé avec succès.',
        ]);
    }

    /**
     * Suppression multiple.
     */
    public function destroyMultiple(Request $request)
    {
        $validated = $request->validate([
            'all_id' => [
                'required',
                'array',
                'min:1',
            ],
            'all_id.*' => [
                'required',
                'integer',
                'distinct',
                'exists:events,id',
            ],
        ]);

        $events = Event::with('images')
            ->whereIn('id', $validated['all_id'])
            ->get();

        DB::transaction(function () use ($events) {
            foreach ($events as $event) {
                $event->images()->delete();
                $event->delete();
            }
        });

        foreach ($events as $event) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }

            foreach ($event->images as $image) {
                Storage::disk('public')->delete($image->image);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Les événements sélectionnés ont été supprimés.',
        ]);
    }

    /**
     * Générer un slug unique à partir du titre.
     */
    private function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (
            Event::where('slug', $slug)
                ->when($ignoreId, function ($query) use ($ignoreId) {
                    $query->where('id', '!=', $ignoreId);
                })
                ->exists()
        ) {
            $slug = $originalSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
