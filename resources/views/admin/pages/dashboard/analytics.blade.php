
@extends('admin.layouts.base')

@section('title', 'Dashboard Analytics - ' . config('app.name'))

@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="#">Solidarité Plus</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Tableau de bord
                        </li>
                    </ol>
                </div>

                <h4 class="page-title">Tableau de bord</h4>

                <p class="text-muted">
                    Vue d'ensemble des activités de Solidarité Plus.
                </p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">

        <!-- Total Donations -->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-muted fw-normal mt-0">
                                Total des dons
                            </h5>

                            <h3 class="mt-3 mb-3">
                                {{ number_format($totalDonations) }}
                            </h3>

                            <p class="mb-0 text-muted">
                                {{ $todayDonations }} don(s) aujourd'hui
                            </p>
                        </div>

                        <div class="avatar-sm">
                            <span class="avatar-title bg-primary rounded">
                                <i class="mdi mdi-cash-multiple font-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Donations -->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-muted fw-normal mt-0">
                                Dons ce mois
                            </h5>

                            <h3 class="mt-3 mb-3">
                                {{ number_format($monthlyDonations) }}
                            </h3>

                            <p class="mb-0 text-muted">
                                Donations enregistrées
                            </p>
                        </div>

                        <div class="avatar-sm">
                            <span class="avatar-title bg-warning rounded">
                                <i class="mdi mdi-calendar-month font-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Events -->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-muted fw-normal mt-0">
                                Événements
                            </h5>

                            <h3 class="mt-3 mb-3">
                                {{ number_format($totalEvents) }}
                            </h3>

                            <p class="mb-0 text-muted">
                                <span class="text-success">
                                    {{ $publishedEvents }}
                                </span>
                                publiés
                            </p>
                        </div>

                        <div class="avatar-sm">
                            <span class="avatar-title bg-success rounded">
                                <i class="mdi mdi-calendar-star font-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Contents -->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-muted fw-normal mt-0">
                                Contenus actifs
                            </h5>

                            <h3 class="mt-3 mb-3">
                                {{ number_format($activeContents) }}
                            </h3>

                            <p class="mb-0 text-muted">
                                Sur {{ $totalContents }} contenus
                            </p>
                        </div>

                        <div class="avatar-sm">
                            <span class="avatar-title bg-info rounded">
                                <i class="mdi mdi-file-document-outline font-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Donation Amounts -->
    <div class="row">

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="header-title mb-0">
                            Montants des dons par devise
                        </h4>

                        <i class="mdi mdi-cash-multiple font-24 text-success"></i>
                    </div>

                    @forelse($donationAmounts as $donation)

                        <div class="d-flex justify-content-between align-items-center border-bottom py-3">

                            <div>
                                <h5 class="mb-0">
                                    {{ $donation->currency }}
                                </h5>

                                <small class="text-muted">
                                    Montant total enregistré
                                </small>
                            </div>

                            <h4 class="mb-0 text-success">
                                {{ number_format((float) $donation->total, 2) }}
                                {{ $donation->currency }}
                            </h4>

                        </div>

                    @empty

                        <div class="text-center py-4">
                            <i class="mdi mdi-cash-remove font-24 text-muted"></i>

                            <p class="text-muted mt-2 mb-0">
                                Aucun don enregistré pour le moment.
                            </p>
                        </div>

                    @endforelse

                </div>
            </div>
        </div>

        <!-- Events Summary -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title mb-3">
                        Aperçu des événements
                    </h4>

                    <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                        <div>
                            <h5 class="mb-1">Total des événements</h5>
                            <small class="text-muted">
                                Tous les événements enregistrés
                            </small>
                        </div>

                        <h4 class="mb-0">
                            {{ $totalEvents }}
                        </h4>
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                        <div>
                            <h5 class="mb-1">Événements publiés</h5>
                            <small class="text-muted">
                                Visibles sur le site
                            </small>
                        </div>

                        <h4 class="mb-0 text-success">
                            {{ $publishedEvents }}
                        </h4>
                    </div>

                    <div class="d-flex justify-content-between align-items-center py-3">
                        <div>
                            <h5 class="mb-1">Événements en brouillon</h5>
                            <small class="text-muted">
                                Non encore publiés
                            </small>
                        </div>

                        <h4 class="mb-0 text-warning">
                            {{ $draftEvents }}
                        </h4>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Recent Donations and Upcoming Events -->
    <div class="row">

        <!-- Recent Donations -->
        <div class="col-xl-7">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h4 class="header-title mb-0">
                            Dernières donations
                        </h4>

                        <a href="{{ route('donations.index') }}"
                           class="btn btn-sm btn-light">
                            Voir tout
                            <i class="mdi mdi-arrow-right ms-1"></i>
                        </a>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered table-hover mb-0">

                            <thead>
                                <tr>
                                    <th>Donateur</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($recentDonations as $donation)

                                    <tr>
                                        <td>
                                            <h5 class="font-14 my-1">
                                                {{ $donation->donor_name }}
                                            </h5>

                                            <small class="text-muted">
                                                {{ $donation->donor_email ?? 'Email non renseigné' }}
                                            </small>
                                        </td>

                                        <td>
                                            <strong>
                                                {{ number_format((float) $donation->amount, 2) }}
                                                {{ $donation->currency }}
                                            </strong>
                                        </td>

                                        <td>
                                            <small class="text-muted">
                                                {{ $donation->created_at?->format('d/m/Y') }}
                                            </small>
                                        </td>
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            Aucune donation enregistrée.
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="col-xl-5">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h4 class="header-title mb-0">
                            Prochains événements
                        </h4>

                        <a href="{{ route('admin.events.index') }}"
                           class="btn btn-sm btn-light">
                            Voir tout
                            <i class="mdi mdi-arrow-right ms-1"></i>
                        </a>

                    </div>

                    @forelse($upcomingEvents as $event)

                        <div class="d-flex align-items-start border-bottom py-3">

                            <div class="me-3">
                                <span class="avatar-sm bg-light rounded d-flex align-items-center justify-content-center">
                                    <i class="mdi mdi-calendar-outline text-primary font-24"></i>
                                </span>
                            </div>

                            <div class="flex-grow-1">

                                <h5 class="font-14 mt-0 mb-1">
                                    {{ $event->title }}
                                </h5>

                                <p class="text-muted mb-1">
                                    <i class="mdi mdi-map-marker-outline me-1"></i>
                                    {{ $event->location ?? 'Lieu non renseigné' }}
                                </p>

                                <small class="text-success">
                                    {{ $event->start_date?->format('d/m/Y à H:i') }}
                                </small>

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-4">
                            <i class="mdi mdi-calendar-blank-outline font-24 text-muted"></i>

                            <p class="text-muted mt-2 mb-0">
                                Aucun événement à venir.
                            </p>
                        </div>

                    @endforelse

                </div>
            </div>
        </div>

    </div>

</div>

@endsection
