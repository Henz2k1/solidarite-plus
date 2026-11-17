
@extends('admin.layouts.base')

@section('title', 'Gestion des événements')

@section('content')

<div class="container-fluid">

    {{-- En-tête --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">

                <div>
                    <h4 class="page-title">Gestion des événements</h4>

                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.analytics') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Événements
                        </li>
                    </ol>
                </div>

                <a href="{{ route('admin.events.create') }}"
                   class="btn btn-primary">
                    <i class="mdi mdi-plus me-1"></i>
                    Nouvel événement
                </a>

            </div>
        </div>
    </div>


    {{-- Statistiques --}}
    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-muted fw-normal mt-0">
                                Total événements
                            </h5>
                            <h3 class="mt-2 mb-0" id="totalEvents">
                                {{ $stats['total'] }}
                            </h3>
                        </div>

                        <div class="avatar-sm">
                            <span class="avatar-title bg-soft-primary text-primary rounded">
                                <i class="mdi mdi-calendar-multiple font-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-muted fw-normal mt-0">
                                Événements publiés
                            </h5>
                            <h3 class="mt-2 mb-0 text-success">
                                {{ $stats['published'] }}
                            </h3>
                        </div>

                        <div class="avatar-sm">
                            <span class="avatar-title bg-soft-success text-success rounded">
                                <i class="mdi mdi-check-circle-outline font-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-muted fw-normal mt-0">
                                Brouillons
                            </h5>
                            <h3 class="mt-2 mb-0 text-warning">
                                {{ $stats['draft'] }}
                            </h3>
                        </div>

                        <div class="avatar-sm">
                            <span class="avatar-title bg-soft-warning text-warning rounded">
                                <i class="mdi mdi-file-document-edit-outline font-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- Tableau des événements --}}
    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

                        <div>
                            <h4 class="header-title mb-1">
                                Liste des événements
                            </h4>

                            <p class="text-muted mb-0">
                                Gérez les événements et leurs galeries de photos.
                            </p>
                        </div>

                        <button type="button"
                                class="btn btn-danger btn-sm"
                                id="deleteSelectedBtn"
                                data-url="{{ route('events.destroyMultiple') }}"
                                disabled>

                            <i class="mdi mdi-delete me-1"></i>
                            Supprimer la sélection

                        </button>

                    </div>


                    <div class="table-responsive">

                        <table id="events-dt"
                               class="table table-centered table-striped dt-responsive nowrap w-100">

                            <thead>
                                <tr>
                                    <th style="width: 30px;">
                                        <div class="form-check">
                                            <input type="checkbox"
                                                   class="form-check-input"
                                                   id="checkAll">
                                        </div>
                                    </th>

                                    <th>Événement</th>
                                    <th>Lieu</th>
                                    <th>Date de début</th>
                                    <th>Galerie</th>
                                    <th>Statut</th>
                                    <th style="width: 90px;">Actions</th>
                                </tr>
                            </thead>

                            <tbody></tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection


@push('scripts')

<script>
$(document).ready(function () {

    // Initialisation DataTables
    const table = $('#events-dt').DataTable({

        processing: true,
        serverSide: true,

        ajax: "{{ route('events.index') }}",

        pageLength: 10,

        order: [],

        columns: [

            {
                data: 'checkbox',
                name: 'checkbox',
                orderable: false,
                searchable: false
            },

            {
                data: 'title',
                name: 'title'
            },

            {
                data: 'location',
                name: 'location'
            },

            {
                data: 'start_date',
                name: 'start_date'
            },

            {
                data: 'gallery_count',
                name: 'gallery_count',
                orderable: false,
                searchable: false,
                render: function (data) {
                    return `
                        <span class="badge bg-soft-info text-info">
                            <i class="mdi mdi-image-multiple-outline me-1"></i>
                            ${data} photo(s)
                        </span>
                    `;
                }
            },

            {
                data: 'status',
                name: 'status'
            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }

        ],

        language: {
            processing: "Chargement...",
            search: "Rechercher :",
            lengthMenu: "Afficher _MENU_ éléments",
            info: "Affichage de _START_ à _END_ sur _TOTAL_ événements",
            infoEmpty: "Aucun événement disponible",
            infoFiltered: "(filtré sur _MAX_ événements)",
            zeroRecords: "Aucun événement correspondant trouvé",
            emptyTable: "Aucun événement enregistré",
            paginate: {
                first: "Premier",
                last: "Dernier",
                next: "Suivant",
                previous: "Précédent"
            }
        }

    });


    // Gestion de la sélection
    function updateDeleteButton() {

        const checked = $('.check-row:checked').length;

        $('#deleteSelectedBtn').prop('disabled', checked === 0);

        const total = $('.check-row').length;

        $('#checkAll').prop(
            'checked',
            total > 0 && checked === total
        );
    }


    $(document).on('change', '#checkAll', function () {

        $('.check-row').prop('checked', this.checked);

        updateDeleteButton();

    });


    $(document).on('change', '.check-row', function () {

        updateDeleteButton();

    });


    table.on('draw', function () {

        $('#checkAll').prop('checked', false);

        updateDeleteButton();

        $('#totalEvents').text(table.page.info().recordsDisplay);

    });


    // Suppression individuelle
    $(document).on('click', '.delete-btn', function () {

        const url = $(this).data('url');

        Swal.fire({

            title: 'Supprimer cet événement ?',

            text: 'Cette opération supprimera également sa galerie de photos.',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#d33',

            cancelButtonColor: '#6c757d',

            confirmButtonText: 'Oui, supprimer',

            cancelButtonText: 'Annuler'

        }).then(function (result) {

            if (!result.isConfirmed) {
                return;
            }

            $.ajax({

                url: url,
                type: 'DELETE',

                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function (response) {

                    Swal.fire(
                        'Supprimé !',
                        response.message,
                        'success'
                    );

                    table.ajax.reload(null, false);

                },

                error: function (xhr) {

                    Swal.fire(
                        'Erreur',
                        xhr.responseJSON?.message || 'Impossible de supprimer cet événement.',
                        'error'
                    );

                }

            });

        });

    });


    // Suppression multiple
    $('#deleteSelectedBtn').on('click', function () {

        const url = $(this).data('url');

        const selectedIds = $('.check-row:checked').map(function () {

            return $(this).val();

        }).get();


        if (selectedIds.length === 0) {
            return;
        }


        Swal.fire({

            title: 'Supprimer les événements sélectionnés ?',

            text: selectedIds.length + ' événement(s) seront supprimés définitivement.',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#d33',

            cancelButtonColor: '#6c757d',

            confirmButtonText: 'Oui, supprimer',

            cancelButtonText: 'Annuler'

        }).then(function (result) {

            if (!result.isConfirmed) {
                return;
            }

            $.ajax({

                url: url,

                type: 'DELETE',

                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    all_id: selectedIds
                },

                success: function (response) {

                    Swal.fire(
                        'Succès',
                        response.message,
                        'success'
                    );

                    $('#checkAll').prop('checked', false);

                    table.ajax.reload(null, false);

                },

                error: function (xhr) {

                    Swal.fire(
                        'Erreur',
                        xhr.responseJSON?.message || 'Une erreur est survenue.',
                        'error'
                    );

                }

            });

        });

    });

});
</script>

@endpush
