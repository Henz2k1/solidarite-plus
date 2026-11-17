<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Donation;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques des dons
        $totalDonations = Donation::count();

        $todayDonations = Donation::whereDate(
            'created_at',
            today()
        )->count();

        $monthlyDonations = Donation::whereMonth(
            'created_at',
            now()->month
        )
            ->whereYear('created_at', now()->year)
            ->count();

        // Montants des dons par devise
        $donationAmounts = Donation::selectRaw(
            'currency, SUM(amount) as total'
        )
            ->groupBy('currency')
            ->get();

        // Derniers dons enregistrés
        $recentDonations = Donation::latest()
            ->take(5)
            ->get();

        // Statistiques des événements
        $totalEvents = Event::count();

        $publishedEvents = Event::where(
            'status',
            'published'
        )->count();

        $draftEvents = Event::where(
            'status',
            'draft'
        )->count();

        // Prochains événements
        $upcomingEvents = Event::where(
            'start_date',
            '>=',
            now()
        )
            ->where('status', 'published')
            ->orderBy('start_date')
            ->take(5)
            ->get();

        // Statistiques des contenus
        $totalContents = Content::count();

        $activeContents = Content::where(
            'is_active',
            true
        )->count();

        return view('admin.pages.dashboard.analytics', compact(
            'totalDonations',
            'todayDonations',
            'monthlyDonations',
            'donationAmounts',
            'recentDonations',
            'totalEvents',
            'publishedEvents',
            'draftEvents',
            'upcomingEvents',
            'totalContents',
            'activeContents'
        ));
    }
}
