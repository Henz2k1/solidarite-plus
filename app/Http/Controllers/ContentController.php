<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class ContentController extends Controller
{
    /**
     * Afficher la liste des contenus.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $contents = Content::query()->latest();

            return DataTables::of($contents)
                ->addIndexColumn()

                // Checkbox de sélection
                ->addColumn('checkbox', function ($row) {
                    return '<div class="form-check font-16 mb-0">
                                <input class="form-check-input check-row"
                                    name="single-row"
                                    value="'.$row->id.'"
                                    type="checkbox"
                                    id="contentlist'.$row->id.'">

                                <label class="form-check-input-label"
                                    for="contentlist'.$row->id.'">&nbsp;</label>
                            </div>';
                })

                // Clé du contenu
                ->editColumn('content_key', function ($row) {
                    return '<span class="fw-bold">'.e($row->content_key).'</span>';
                })

                // Page concernée
                ->editColumn('page', function ($row) {
                    return '<span class="badge bg-soft-info text-info">'
                        .e($row->page ?? 'Global').
                    '</span>';
                })

                // Type de contenu
                ->editColumn('type', function ($row) {
                    return '<span class="badge bg-secondary">'
                        .e($row->type).
                    '</span>';
                })

                // Valeur du contenu
                ->editColumn('content_value', function ($row) {
                    return Str::limit((string) $row->content_value, 50);
                })

                // Statut
                ->addColumn('status', function ($row) {
                    if ($row->is_active) {
                        return '<span class="badge bg-success">Actif</span>';
                    }

                    return '<span class="badge bg-danger">Inactif</span>';
                })

                // Actions
                ->addColumn('action', function ($row) {

                    $editUrl = route('contents.edit', $row->id);
                    $deleteUrl = route('contents.destroy', $row->id);

                    return '
                    <div class="btn-group">

                        <a href="javascript:void(0);"
                            data-url="'.$editUrl.'"
                            class="action-icon text-primary edit-btn"
                            title="Éditer">

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

                // Colonnes contenant du HTML
                ->rawColumns([
                    'checkbox',
                    'content_key',
                    'page',
                    'type',
                    'status',
                    'action',
                ])

                ->make(true);
        }

        // Statistiques
        $stats = [
            'total' => Content::count(),
            'active' => Content::where('is_active', true)->count(),
        ];

        return view('admin.pages.contents.index', compact('stats'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        return view('admin.pages.contents.create');
    }

    /**
     * Enregistrer un nouveau contenu.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content_key' => [
                'required',
                'string',
                'max:150',
                'unique:contents,content_key',
            ],
            'content_value' => [
                'nullable',
                'string',
            ],
            'type' => [
                'required',
                Rule::in(['text', 'html', 'image', 'url', 'number']),
            ],
            'page' => [
                'nullable',
                'string',
                'max:50',
            ],
            'is_active' => [
                'sometimes',
                'boolean',
            ],
            'image_file' => [
                'required_if:type,image',
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        // Gestion du fichier image
        if ($request->type === 'image') {
            $path = $request->file('image_file')->store(
                'contents',
                'public'
            );

            $validated['content_value'] = $path;
        }

        // Ne pas transmettre le fichier comme attribut du modèle
        unset($validated['image_file']);

        // Gestion de la case à cocher
        $validated['is_active'] = $request->boolean('is_active');

        Content::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Contenu créé avec succès.',
        ]);
    }

    /**
     * Récupérer un contenu pour modification.
     */
    public function edit(Content $content)
    {
        return response()->json([
            'status' => true,
            'data' => $content,
        ]);
    }

    /**
     * Mettre à jour un contenu existant.
     */
    public function update(Request $request, Content $content)
    {
        $validated = $request->validate([
            'content_key' => [
                'required',
                'string',
                'max:150',
                Rule::unique('contents', 'content_key')
                    ->ignore($content->id),
            ],
            'content_value' => [
                'nullable',
                'string',
            ],
            'type' => [
                'required',
                Rule::in(['text', 'html', 'image', 'url', 'number']),
            ],
            'page' => [
                'nullable',
                'string',
                'max:50',
            ],
            'is_active' => [
                'sometimes',
                'boolean',
            ],
            'image_file' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $oldImage = $content->content_value;

        // Si le type est image, il faut une nouvelle image
        // ou une image déjà enregistrée.
        if (
            $request->type === 'image' &&
            ! $request->hasFile('image_file') &&
            (
                $content->type !== 'image' ||
                empty($content->content_value)
            )
        ) {
            return response()->json([
                'message' => 'Une image est obligatoire pour ce contenu.',
                'errors' => [
                    'image_file' => [
                        'Veuillez sélectionner une image.',
                    ],
                ],
            ], 422);
        }

        // Si une nouvelle image est envoyée
        if ($request->type === 'image' && $request->hasFile('image_file')) {
            $newPath = $request->file('image_file')->store(
                'contents',
                'public'
            );

            $validated['content_value'] = $newPath;
        }

        unset($validated['image_file']);

        $validated['is_active'] = $request->boolean('is_active');

        // Mise à jour du contenu
        $content->update($validated);

        // Supprimer l'ancienne image uniquement après la mise à jour
        if (
            $request->type === 'image' &&
            $request->hasFile('image_file') &&
            $oldImage &&
            str_starts_with($oldImage, 'contents/')
        ) {
            Storage::disk('public')->delete($oldImage);
        }

        return response()->json([
            'status' => true,
            'message' => 'Contenu mis à jour avec succès.',
        ]);
    }

    /**
     * Supprimer un contenu.
     */
    public function destroy(Content $content)
    {
        $content->delete();

        return response()->json([
            'status' => true,
            'message' => 'Contenu supprimé avec succès.',
        ]);
    }

    /**
     * Supprimer plusieurs contenus.
     */
    public function destroyMultiple(Request $request)
    {
        $validated = $request->validate([
            'all_id' => ['required', 'array', 'min:1'],
            'all_id.*' => ['required', 'integer', 'exists:contents,id'],
        ]);

        Content::whereIn('id', $validated['all_id'])->delete();

        return response()->json([
            'status' => true,
            'message' => 'Les contenus sélectionnés ont été supprimés avec succès.',
        ]);
    }
}
