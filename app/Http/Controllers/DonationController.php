<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DonationController extends Controller
{
    /**
     * Affiche la liste des dons et gère DataTables (Ajax).
     */
   public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Donation::query()->select('id', 'donor_name', 'donor_email', 'donor_phone', 'amount', 'currency', 'created_at')->latest();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return '<div class="form-check font-16 mb-0">
                                <input class="form-check-input check-row" name="single-row" value="'.$row->id.'" type="checkbox" id="donationlist'.$row->id.'">
                                <label class="form-check-input-label" for="donationlist'.$row->id.'">&nbsp;</label>
                            </div>';
                })
                ->editColumn('donor_name', function ($row) {
                    return '<span class="fw-bold text-900">'.$row->donor_name.'</span>';
                })
                ->editColumn('amount', function ($row) {
                    return '<span class="badge badge-phoenix fs-10 badge-phoenix-success fw-bold">'.number_format($row->amount, 2, ',', ' ').' '.$row->currency.'</span>';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('d/m/Y H:i') : '';
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('donations.edit', $row->id);
                    $delete_url = route('donations.destroy', $row->id);

                    return '
                    <div class="btn-group">
                        <a href="javascript:void(0);" data-url="'.$edit_url.'" class="action-icon text-primary edit-btn" title="Éditer">
                            <i class="mdi mdi-square-edit-outline font-18"></i>
                        </a>
                        <a href="javascript:void(0);" data-url="'.$delete_url.'" class="action-icon text-danger delete-btn" title="Supprimer">
                            <i class="mdi mdi-delete font-18"></i>
                        </a>
                    </div>';
                })
                ->rawColumns(['checkbox', 'donor_name', 'amount', 'action'])
                ->make(true);
        }

        $stats = [
            'total_donations' => Donation::count(),
            'total_amount' => number_format(Donation::sum('amount'), 2, ',', ' '),
            'last_donor' => Donation::latest()->value('donor_name') ?? 'Aucun',
        ];

        return view('admin.pages.dons.index', compact('stats'));
    }

    /**
     * Enregistre un nouveau don.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'nullable|email|max:255',
            'donor_phone' => 'nullable|string|max:50',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|size:3',
        ]);

        Donation::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Don enregistré avec succès.',
            'stats' => $this->getStatsData()
        ]);
    }

    /**
     * Récupère les données d'un don pour l'édition (Ajax).
     */
    public function edit(Donation $donation)
    {
        return response()->json([
            'status' => true,
            'data' => $donation,
        ]);
    }

    /**
     * Met à jour le don.
     */
    public function update(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'nullable|email|max:255',
            'donor_phone' => 'nullable|string|max:50',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|size:3',
        ]);

        $donation->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Don mis à jour avec succès.',
            'stats' => $this->getStatsData()
        ]);
    }

    /**
     * Supprime un don.
     */
    public function destroy(Donation $donation)
    {
        $donation->delete();

        return response()->json([
            'status' => true,
            'message' => 'Don supprimé avec succès.',
            'stats' => $this->getStatsData()
        ]);
    }

    /**
     * Suppression multiple de dons.
     */
    public function destroyMultiple(Request $request)
    {
        $ids = $request->input('all_id', []);

        if (empty($ids)) {
            return response()->json([
                'status' => false,
                'message' => 'Aucun don sélectionné.',
            ], 422);
        }

        Donation::whereIn('id', $ids)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Les dons sélectionnés ont été supprimés avec succès.',
            'stats' => $this->getStatsData()
        ]);
    }

    /**
     * Méthode privée pour centraliser le calcul des statistiques.
     */
    private function getStatsData()
    {
        return [
            'total_donations' => Donation::count(),
            'total_amount' => number_format(Donation::sum('amount'), 2, ',', ' '),
            'last_donor' => Donation::latest()->value('donor_name') ?? 'Aucun',
        ];
    }
}
