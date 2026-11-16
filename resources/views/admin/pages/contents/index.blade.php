
@extends('admin.layouts.base')

@section('title', 'Gestion des Contenus - ' . env('APP_NAME'))

@section('content')

    {{-- Titre de la page --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Gestion des Contenus</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.analytics') }}">
                                Tableau de Bord
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Contenus du site
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistiques --}}
    <div class="row" id="stats-container">

        {{-- Total des contenus --}}
        <div class="col-md-6 col-xl-4">
            <div class="card widget-flat custom-card-rounded border-primary-sep shadow-sm">
                <div class="card-body">
                    <div class="float-end">
                        <div class="avatar-sm bg-soft-primary rounded-circle">
                            <i class="fe-file-text avatar-title font-22 text-primary"></i>
                        </div>
                    </div>

                    <h6 class="text-muted text-uppercase mt-0">
                        Total Contenus
                    </h6>

                    <h3 class="my-2" id="total-contents">
                        {{ $stats['total'] }}
                    </h3>

                    <p class="mb-0 text-muted">
                        <span class="small fw-medium">Clés configurées</span>
                    </p>
                </div>
            </div>
        </div>

        {{-- Contenus actifs --}}
        <div class="col-md-6 col-xl-4">
            <div class="card widget-flat custom-card-rounded border-success-sep shadow-sm">
                <div class="card-body">
                    <div class="float-end">
                        <div class="avatar-sm bg-soft-success rounded-circle">
                            <i class="fe-check-circle avatar-title font-22 text-success"></i>
                        </div>
                    </div>

                    <h6 class="text-muted text-uppercase mt-0">
                        Contenus Actifs
                    </h6>

                    <h3 class="my-2 text-success" id="active-contents">
                        {{ $stats['active'] }}
                    </h3>

                    <p class="mb-0 text-muted">
                        <span class="small fw-medium">En ligne sur le site</span>
                    </p>
                </div>
            </div>
        </div>

        {{-- Pages gérées --}}
        <div class="col-md-6 col-xl-4">
            <div class="card widget-flat custom-card-rounded border-info-sep shadow-sm">
                <div class="card-body">
                    <div class="float-end">
                        <div class="avatar-sm bg-soft-info rounded-circle">
                            <i class="fe-layout avatar-title font-22 text-info"></i>
                        </div>
                    </div>

                    <h6 class="text-muted text-uppercase mt-0">
                        Pages Gérées
                    </h6>

                    <h3 class="my-2 text-info"
                        id="pages-contents"
                        style="font-size: 1.4rem; padding-top: 5px;">
                        {{-- {{ $stats['pages'] }} --}}
                    </h3>

                    <p class="mb-0 text-muted">
                        <span class="small fw-medium">Pages configurées</span>
                    </p>
                </div>
            </div>
        </div>

    </div>

    {{-- Tableau principal --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- Barre d'actions --}}
                    <div class="row mb-2">

                        <div class="col-sm-4">
                            <a href="{{ route('contents.create') }}"
                                class="btn btn-primary mb-2">

                                <i class="mdi mdi-plus-circle me-1"></i>
                                Ajouter un contenu
                            </a>
                        </div>

                        <div class="col-sm-8">
                            <div class="text-sm-end">

                                <button
                                    data-url="#"
                                    type="button"
                                    class="btn btn-danger mb-2 me-1 delete-all">

                                    <i class="mdi mdi-trash-can-outline"></i>
                                    Supprimer la sélection
                                </button>

                                <a href="javascript:void(0);"
                                    class="btn btn-primary mb-2">

                                    <i class="mdi mdi-printer me-1"></i>
                                    Imprimer
                                </a>

                                <a href="javascript:void(0);"
                                    class="btn btn-success mb-2">

                                    <i class="mdi mdi-database-export me-1"></i>
                                    Exporter
                                </a>

                            </div>
                        </div>

                    </div>

                    {{-- Message de succès --}}
                    @if (session()->has('success'))
                        <div class="alert alert-success solid alert-dismissible fade show mt-3 mb-2">

                            <svg viewBox="0 0 24 24"
                                width="24"
                                height="24"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="me-2">

                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>

                            <strong>Succès !</strong>
                            {{ session()->get('success') }}

                            <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="btn-close">
                            </button>

                        </div>
                    @endif

                    {{-- Tableau DataTables --}}
                    <div class="table-responsive">

                        <table
                            class="table table-centered dt-responsive nowrap w-100"
                            id="contents-dt"
                            data-api-url="{{ route('contents.index') }}">

                            <thead class="table-light">
                                <tr>

                                    <th style="width: 20px;">
                                        <div class="form-check font-16 mb-0">
                                            <input
                                                id="checkAllRows"
                                                class="form-check-input"
                                                type="checkbox">

                                            <label
                                                class="form-check-input-label"
                                                for="checkAllRows">
                                                &nbsp;
                                            </label>
                                        </div>
                                    </th>

                                    <th>Clé unique</th>
                                    <th>Page</th>
                                    <th>Type</th>
                                    <th>Valeur (Aperçu)</th>
                                    <th>Statut</th>

                                    <th style="width: 75px;" class="text-center">
                                        Action
                                    </th>

                                </tr>
                            </thead>

                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

<script>
    $(document).ready(function() {

        // Configuration CSRF
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        // Initialisation DataTables
        let currentDt = $("#contents-dt").DataTable({

            autoWidth: false,
            processing: true,
            serverSide: true,
            searchDelay: 1000,
            paging: true,
            order: [[1, "asc"]],

            ajax: {
                url: $("#contents-dt").attr("data-api-url"),
                type: "GET"
            },

            pageLength: 10,

            columns: [

                {
                    data: "checkbox",
                    name: "checkbox",
                    orderable: false,
                    searchable: false
                },

                {
                    data: "content_key",
                    name: "content_key",
                    className: "text-900 fw-bold align-middle white-space-wrap"
                },

                {
                    data: "page",
                    name: "page",
                    className: "text-900 align-middle white-space-nowrap"
                },

                {
                    data: "type",
                    name: "type",
                    className: "text-900 align-middle white-space-nowrap"
                },

                {
                    data: "content_value",
                    name: "content_value",
                    className: "text-900 align-middle white-space-wrap"
                },

                {
                    data: "status",
                    name: "status",
                    orderable: false,
                    searchable: false,
                    className: "text-900 align-middle text-center white-space-nowrap"
                },

                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                    className: "align-middle text-center"
                }

            ],

            lengthMenu: [10, 25, 50, 100],

            language: {
                processing: "Traitement en cours...",
                search: "Rechercher ",
                lengthMenu: "Afficher _MENU_ contenus",
                info: "Affichage de _START_ à _END_ sur _TOTAL_ contenus",
                infoEmpty: "Aucun contenu disponible",
                infoFiltered: "(filtré sur _MAX_ contenus)",
                emptyTable: "Aucun contenu disponible.",
                zeroRecords: "Aucun résultat trouvé.",
                paginate: {
                    next: "Suivant",
                    previous: "Précédent"
                }
            },

            drawCallback: function(settings) {
                $('#total-contents').text(settings._iRecordsTotal);
            }

        });


        // ==========================================
        // SUPPRESSION INDIVIDUELLE
        // ==========================================

        $(document).on('click', '.delete-btn', function(e) {

            e.preventDefault();

            let url = $(this).attr('data-url');

            Swal.fire({
                title: "Êtes-vous sûr ?",
                text: "Cette action est irréversible !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Oui, supprimer !",
                cancelButtonText: "Annuler"

            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({

                        url: url,
                        method: 'DELETE',
                        dataType: 'json',

                        success: function(response) {

                            Swal.fire(
                                "Supprimé !",
                                response.message,
                                "success"
                            );

                            currentDt.ajax.reload(null, false);

                            $('#checkAllRows').prop('checked', false);
                        },

                        error: function(xhr) {

                            let errorMsg = xhr.responseJSON?.message
                                ?? "Une erreur est survenue.";

                            Swal.fire(
                                "Erreur",
                                errorMsg,
                                "error"
                            );
                        }

                    });

                }

            });

        });


        // ==========================================
        // SÉLECTION DE TOUTES LES LIGNES
        // ==========================================

        $(document).on('change', '#checkAllRows', function() {

            $('.check-row').prop('checked', $(this).prop('checked'));

        });


        // Désélectionner l'en-tête si une ligne est décochée
        $(document).on('change', '.check-row', function() {

            let totalRows = $('.check-row').length;
            let checkedRows = $('.check-row:checked').length;

            $('#checkAllRows').prop(
                'checked',
                totalRows > 0 && totalRows === checkedRows
            );

        });


        // ==========================================
        // SUPPRESSION MULTIPLE
        // ==========================================

        $(document).on('click', '.delete-all', function() {

            const checkedCount = $('.check-row:checked').length;
            const url = $(this).attr('data-url');

            if (checkedCount < 1) {

                Swal.fire(
                    "Oups...",
                    "Vous devez sélectionner au moins une ligne.",
                    "warning"
                );

                return;
            }

            let all_id = [];

            $('.check-row:checked').each(function() {
                all_id.push($(this).val());
            });

            Swal.fire({

                title: "Êtes-vous sûr ?",
                text: "Vous allez supprimer " + checkedCount + " contenus !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1abc9c",
                cancelButtonColor: "#f1556c",
                confirmButtonText: "Oui, tout supprimer !",
                cancelButtonText: "Annuler"

            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({

                        url: url,
                        method: 'DELETE',

                        data: {
                            all_id: all_id
                        },

                        success: function(response) {

                            Swal.fire({
                                title: "Supprimés !",
                                text: response.message,
                                icon: "success",
                                confirmButtonColor: "#1abc9c"
                            });

                            currentDt.ajax.reload(null, false);

                            $('#checkAllRows').prop('checked', false);

                        },

                        error: function(xhr) {

                            let errorMsg = xhr.responseJSON?.message
                                ?? "Une erreur est survenue lors de l'opération.";

                            Swal.fire({
                                icon: "error",
                                title: "Oups...",
                                text: errorMsg,
                                confirmButtonColor: "#3bafda"
                            });

                        }

                    });

                }

            });

        });

    });
</script>

@endpush
