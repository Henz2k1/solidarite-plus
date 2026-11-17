<?php

namespace App\Http\Controllers;

use App\HasPermission;
use App\Models\ActivityLog;
use App\Models\Roles;
use App\Models\User;
use App\Notifications\NewUserAdded;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    use HasPermission;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->checkPermission('utilisateurs', 'read');
        if ($request->ajax()) {
            $users = User::latest()->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return '<div class="form-check mb-0">
                                <input class="form-check-input check-row" name="single-row" value="'.$row->id.'" type="checkbox" id="customerlist'.$row->id.'">
                                <label class="form-check-label" for="customerlist01">&nbsp;</label>
                            </div>';
                })

                ->addColumn('name', function ($row) {
                    $url = asset($row->photo);
                    $render = ' <div class="d-flex">
                                    <img style="width:30px;height:30px;" src="'.$url.'" alt="table-user"
                                        class="me-3 rounded-circle avatar-sm">
                                    <div class="flex-1">
                                    <p class="mb-0 ms-1 text-body-emphasis fw-bold"> '.$row->name.'</p>

                                        <p class="mb-0 ms-1 font-13">Role : '.Str::ucfirst($row->roles->name) ?? 'N/A'.'</p>
                                    </div>
                                </div>';

                    return $render;
                })
                ->addColumn('status', function ($row) {
                    $status = $row->status;
                    $color = 'success';
                    $status_display = 'Activé';
                    if ($status == 'off') {
                        $color = 'danger';
                        $status_display = 'Désactivé';
                    }
                    $render = '<span class="badge badge-phoenix fs-10 badge-phoenix-'.$color.'"><span class="badge-label">'.$status_display.'</span></span>';

                    return $render;
                })
                ->addColumn('date', function ($row) {

                    return Carbon::parse($row->created_at)->toDateString();
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('utilisateurs.edit', ['utilisateur' => $row->id]);
                    $delete_url = route('utilisateurs.destroy', ['utilisateur' => $row->id]);
                    $resend_url = route('resend-cred', ['id' => $row->id]);
                    $actionBtn = '
                    <div class="btn-reveal-trigger position-static">
                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-2">
                            <a class="dropdown-item" href="#!">Détails</a>
                            <a class="dropdown-item resendCred" href="#!" data-url="'.$resend_url.'">Renvoi Credentials</a>
                            <a class="dropdown-item edit-btn" href="#!" data-id="'.$row->id.'" data-url="'.$edit_url.'">Editer</a>
                            <div class="dropdown-divider">
                        </div>
                        <a class="dropdown-item text-danger delete-btn" href="#!" data-id="'.$row->id.'" data-url="'.$delete_url.'">Supprimer</a>
                        </div>
                    </div>

                    ';

                    return $actionBtn;
                })
                ->rawColumns(['checkbox', 'name', 'status', 'date', 'action'])
                ->make(true);
        }
        $stats = [
            'total' => User::count(),
            'active' => User::where('status', 'on')->count(),
            'inactive' => User::where('status', 'off')->count(),
            'admins' => User::whereHas('roles', function ($query) {
                $query->where('name', 'Super Admin');
            })->count(),
        ];

        $roles = Roles::orderBy('name', 'asc')->get();

        return view('admin.pages.users.index', compact('roles', 'stats'));
    }

    public function profile()
    {
        return view('admin.pages.users.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validation basique
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'oldPassword' => 'nullable|required_with:newPassword|string',
            'newPassword' => 'nullable|min:6|confirmed',
        ]);

        // Mise à jour des infos basiques
        $user->name = $request->name;
        $user->contact = $request->contact;

        // Upload photo si présente
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('uploads/users', 'public');
            $user->photo = 'storage/'.$path;
        }

        $passwordChanged = false;

        // Mise à jour mot de passe si demandé
        if ($request->filled('oldPassword') && $request->filled('newPassword')) {
            if (! Hash::check($request->oldPassword, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ancien mot de passe incorrect',
                ], 422);
            }

            $user->password = Hash::make($request->newPassword);
            $passwordChanged = true;
        }

        $user->save();

        if ($passwordChanged) {
            Auth::logout();

            return response()->json([
                'status' => true,
                'redirect' => route('login'),
                'message' => 'Mot de passe changé avec succès, veuillez vous reconnecter.',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Profil mis à jour avec succès',
            'user' => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function resendCred(Request $request)
    {
        $user = User::find($request->id);

        if (! $user) {
            return response()->json([
                'status' => false,
                'message' => 'Utilisateur introuvable',
            ], 404);
        }

        DB::transaction(function () use ($user) {
            // Générer un nouveau mot de passe
            $password = Str::random(10);
            $user->password = Hash::make($password);
            $user->save();

            // Dispatcher la notification **après le commit** avec délai
            $user->notify(
                (new NewUserAdded($password, $user->roleName))
                    ->delay(now()->addSeconds(5))
                    ->afterCommit() // IMPORTANT pour que ça fonctionne avec la transaction
            );
        });

        return response()->json([
            'status' => true,
            'message' => 'Mail envoyé avec succès',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->checkPermission('utilisateurs', 'create');

        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:50',
                'email' => 'required|email|max:50|unique:users,email',
                'contact' => 'nullable|string|max:50',
                'gender' => 'required|in:M,F',
                'role_id' => 'required|exists:roles,id',
                'status' => 'required|in:on,off',
                'photo' => 'sometimes|image|mimes:jpg,jpeg,png,svg|max:2048',
            ]);

            $passwordPlain = Str::random(8);
            $validated['password'] = Hash::make($passwordPlain);

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileName = time().'.'.$file->getClientOriginalExtension();
                $file->storeAs('users', $fileName, 'public');
                $validated['photo'] = 'storage/users/'.$fileName;
            } else {
                $validated['photo'] = 'storage/users/avatar-male.png';
            }

            $user = User::create($validated);

            if ($user) {
                $roleName = optional($user->role)->name ?? 'Utilisateur';
                $delay = now()->addSeconds(5);
                $notification = (new NewUserAdded($passwordPlain, $roleName))->delay($delay);
                $user->notify($notification);
            }

            $actorName = optional(Auth::user())->name ?? 'Utilisateur inconnu';
            ActivityLog::create([
                'action' => 'Création d’un utilisateur',
                'details' => "L’utilisateur {$actorName} a effectué une création d’utilisateur pour {$user->name} (ID: {$user->id}).",
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Utilisateur créé avec succès.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Une erreur est survenue lors de la création : '.$e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $utilisateur)
    {
        $this->checkPermission('utilisateurs', 'update');
        if ($utilisateur) {
            // Log activité
            $actorName = optional(Auth::user())->name ?? 'Utilisateur inconnu';
            ActivityLog::create([
                'action' => 'Consultation d’un utilisateur',
                'details' => "L’utilisateur {$actorName} a consulté les informations de {$utilisateur->name} (ID: {$utilisateur->id}).",
            ]);

            return response()->json([
                'status' => true,
                'data' => $utilisateur,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Une erreur est survenue',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->checkPermission('utilisateurs', 'update');

        DB::beginTransaction();

        try {
            $user = User::find($request->id);

            if (! $user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Utilisateur non trouvé.',
                ], 404);
            }

            $validated = $request->validate([
                'name' => 'sometimes|string|max:50',
                'email' => 'sometimes|email|max:50|unique:users,email,'.$user->id,
                'contact' => 'sometimes|nullable|string|max:50',
                'gender' => 'sometimes|in:M,F',
                'role_id' => 'sometimes|exists:roles,id',
                'status' => 'sometimes|in:on,off',
                'photo' => 'sometimes|image|mimes:jpg,jpeg,png,svg|max:2048',
            ]);

            // Gestion de la photo
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileName = time().'.'.$file->getClientOriginalExtension();
                $file->storeAs('users', $fileName, 'public');
                $validated['photo'] = 'storage/users/'.$fileName;

                // Optionnel : supprime l'ancienne photo pour libérer de l'espace
                // if ($user->photo && $user->photo !== 'storage/users/avatar-male.png') {
                //     Storage::disk('public')->delete(str_replace('storage/', '', $user->photo));
                // }
            }

            $user->update($validated);

            $actorName = optional(Auth::user())->name ?? 'Utilisateur inconnu';
            ActivityLog::create([
                'action' => 'Mise à jour d’un utilisateur',
                'details' => "L’utilisateur {$actorName} a effectué une mise à jour d’utilisateur pour {$user->name} (ID: {$user->id}).",
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Utilisateur mis à jour avec succès.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Une erreur est survenue lors de la mise à jour : '.$e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $utilisateur)
    {
        $this->checkPermission('utilisateurs', 'delete');
        $id = $utilisateur->id;

        // Empêcher qu’un utilisateur se supprime lui-même
        if ($id == Auth::user()->id) {
            return response()->json([
                'status' => false,
                'message' => 'Impossible de continuer cette action',
            ]);
        }

        $deleted = $utilisateur->delete();

        if ($deleted) {
            // Log activité
            $actorName = optional(Auth::user())->name ?? 'Utilisateur inconnu';
            ActivityLog::create([
                'action' => 'Suppression d’un utilisateur',
                'details' => "L’utilisateur {$actorName} a supprimé l’utilisateur {$utilisateur->name} (ID: {$utilisateur->id}).",
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Opération réussie',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Une erreur est survenue',
            ]);
        }
    }

    public function delete_multiples(Request $request)
    {
        $this->checkPermission('utilisateurs', 'delete');
        $data = $request->all_id;

        // On empêche qu'un utilisateur se supprime lui-même
        foreach ($data as $key => $id) {
            if ($id == Auth::user()->id) {
                unset($data[$key]);
            }
        }

        $rows = User::whereIn('id', $data)->delete();

        if ($rows) {
            // Log activité
            $actorName = optional(Auth::user())->name ?? 'Utilisateur inconnu';
            $ids = implode(', ', $data);
            ActivityLog::create([
                'action' => 'Suppression multiple d’utilisateurs',
                'details' => "L’utilisateur {$actorName} a supprimé les utilisateurs avec les IDs : [{$ids}].",
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Opération réussie',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Une erreur est survenue',
            ]);
        }
    }
}
