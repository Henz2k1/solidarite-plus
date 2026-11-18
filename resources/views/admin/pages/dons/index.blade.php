@extends('admin.layouts.base')

@section('title', 'Gestion des Dons - ' . env('APP_NAME'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Gestion des Dons</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.analytics') }}">Tableau de Bord</a>
                        </li>
                        <li class="breadcrumb-item active">Dons</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row" id="stats-container">
        <div class="col-md-6 col-xl-4">
            <div class="card widget-flat custom-card-rounded border-primary-sep shadow-sm">
                <div class="card-body">
                    <div class="float-end">
                        <div class="avatar-sm bg-soft-primary rounded-circle">
                            <i class="fe-gift avatar-title font-22 text-primary"></i>
                        </div>
                    </div>
                    <h6 class="text-muted text-uppercase mt-0">Total Dons</h6>
                    <h3 class="my-2" id="stat-total-donations">{{ $stats['total_donations'] }}</h3>
                    <p class="mb-0 text-muted"><span class="small fw-medium">Transactions enregistrées</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card widget-flat custom-card-rounded border-success-sep shadow-sm">
                <div class="card-body">
                    <div class="float-end">
                        <div class="avatar-sm bg-soft-success rounded-circle">
                            <i class="fe-dollar-sign avatar-title font-22 text-success"></i>
                        </div>
                    </div>
                    <h6 class="text-muted text-uppercase mt-0">Montant Total</h6>
                    <h3 class="my-2 text-success"><span id="stat-total-amount">{{ $stats['total_amount'] }}</span> USD</h3>
                    <p class="mb-0 text-muted"><span class="small fw-medium">Fonds cumulés</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card widget-flat custom-card-rounded border-info-sep shadow-sm">
                <div class="card-body">
                    <div class="float-end">
                        <div class="avatar-sm bg-soft-info rounded-circle">
                            <i class="fe-user-check avatar-title font-22 text-info"></i>
                        </div>
                    </div>
                    <h6 class="text-muted text-uppercase mt-0">Dernier Donateur</h6>
                    <h3 class="my-2 text-info" id="stat-last-donor" style="font-size: 1.2rem; padding-top: 5px;">{{ $stats['last_donor'] }}</h3>
                    <p class="mb-0 text-muted"><span class="small fw-medium">Dernière contribution</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau principal -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#createDonationModal">
                                <i class="mdi mdi-plus-circle me-1"></i> Ajouter un don
                            </button>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                <button data-url="{{ route('donations.destroy.multiple') }}" type="button" class="btn btn-danger mb-2 me-1 delete-all">
                                    <i class="mdi mdi-trash-can-outline"></i> Supprimer la sélection
                                </button>
                                <a href="javascript:void(0);" class="btn btn-success mb-2"><i class="mdi mdi-database-export me-1"></i>Exporter</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered dt-responsive nowrap w-100" id="donations-dt" data-api-url="{{ route('donations.index') }}">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check font-16 mb-0">
                                            <input id="checkAllRows" class="form-check-input" type="checkbox">
                                            <label class="form-check-input-label" for="checkAllRows">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>Donateur</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th style="width: 75px;" class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajout Don -->
    <div class="modal fade" id="createDonationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createDonationForm" action="{{ route('donations.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Enregistrer un nouveau don</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nom du donateur <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="donor_name" placeholder="Ex: Jean Dupont" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="donor_email" placeholder="Ex: jean@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="text" class="form-control" name="donor_phone" placeholder="Ex: +243...">
                        </div>
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Montant <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0.01" class="form-control" name="amount" placeholder="Ex: 100" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Devise</label>
                                <select class="form-select" name="currency">
                                    <option value="USD" selected>USD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="CDF">CDF</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Édition Don -->
    <div class="modal fade" id="donationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="donationForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="donation_id">

                    <div class="modal-header">
                        <h5 class="modal-title">Modifier le Don</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nom du donateur</label>
                            <input type="text" class="form-control" name="donor_name" id="edit_donor_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="donor_email" id="edit_donor_email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="text" class="form-control" name="donor_phone" id="edit_donor_phone">
                        </div>
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Montant</label>
                                <input type="number" step="0.01" class="form-control" name="amount" id="edit_amount" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Devise</label>
                                <select class="form-select" name="currency" id="edit_currency">
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="CDF">CDF</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="updateBtn">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        // Configuration du Toast SweetAlert2 (non bloquant)
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // Fonction pour mettre à jour les statistiques en direct
        function updateStats(stats) {
            if (stats) {
                $('#stat-total-donations').text(stats.total_donations);
                $('#stat-total-amount').text(stats.total_amount);
                $('#stat-last-donor').text(stats.last_donor);
            }
        }

        let currentDt = $("#donations-dt").DataTable({
            autoWidth: false,
            order: [[5, "desc"]],
            processing: true,
            serverSide: true,
            searchDelay: 1000,
            paging: true,
            ajax: {
                url: $("#donations-dt").attr("data-api-url"),
            },
            iDisplayLength: 10,
            columns: [
                { data: "checkbox", name: "checkbox", orderable: false, searchable: false },
                { data: "donor_name", name: "donor_name", className: "text-900 fw-bold align-middle" },
                { data: "donor_email", name: "donor_email", className: "text-900 align-middle" },
                { data: "donor_phone", name: "donor_phone", className: "text-900 align-middle" },
                { data: "amount", name: "amount", className: "text-900 align-middle" },
                { data: "created_at", name: "created_at", className: "text-900 align-middle" },
                { data: "action", name: "action", orderable: false, searchable: false, className: "align-middle text-center" },
            ],
            lengthMenu: [10, 25, 50, 100],
            language: {
                "sProcessing": "Traitement en cours...",
                "sSearch": "Rechercher ",
                "sLengthMenu": "Afficher _MENU_ dons",
                "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ dons",
                "sEmptyTable": "Aucun don disponible.",
                "oPaginate": { "sNext": "Suivant", "sPrevious": "Précédent" }
            }
        });

            // Soumission du formulaire d'ajout (Modal)
        $('#createDonationForm').on('submit', function(e) {
            e.preventDefault();
            let form = $(this);
            let saveBtn = $('#saveBtn');

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                beforeSend: function() {
                    saveBtn.prop('disabled', true).text('Enregistrement...');
                },
                success: function(response) {
                    if (response.status) {
                        $('#createDonationModal').modal('hide');
                        form[0].reset();

                        // Notification Toast de succès
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });

                        // RECHARGEMENT DU DATATABLES (Le 'false' permet de garder la position active de pagination)
                        currentDt.ajax.reload(null, false);

                        // Mise à jour des cartes de statistiques avec les données reçues
                        updateStats(response.stats);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let msg = "";
                        $.each(errors, function(k, v) { msg += v[0] + "<br>"; });
                        Swal.fire({ title: "Erreur de validation", html: msg, icon: "error" });
                    } else {
                        Toast.fire({ icon: 'error', title: 'Une erreur est survenue.' });
                    }
                },
                complete: function() {
                    saveBtn.prop('disabled', false).text('Enregistrer');
                }
            });
        });

        // Ouvrir le modal d'édition
        $(document).on('click', '.edit-btn', function() {
            let url = $(this).attr('data-url');

            $.get(url, function(response) {
                if (response.status) {
                    let d = response.data;
                    $('#donation_id').val(d.id);
                    $('#edit_donor_name').val(d.donor_name);
                    $('#edit_donor_email').val(d.donor_email);
                    $('#edit_donor_phone').val(d.donor_phone);
                    $('#edit_amount').val(d.amount);
                    $('#edit_currency').val(d.currency);

                    $('#donationModal').modal('show');
                }
            });
        });

        // Soumission du formulaire de mise à jour avec Toast
        $('#donationForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#donation_id').val();
            let url = `/admin/donations/${id}`;
            let updateBtn = $('#updateBtn');

            $.ajax({
                url: url,
                type: 'PUT',
                data: $(this).serialize(),
                beforeSend: function() {
                    updateBtn.prop('disabled', true).text('Mise à jour...');
                },
                success: function(response) {
                    if (response.status) {
                        $('#donationModal').modal('hide');

                        // Notification Toast de succès
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });

                        currentDt.ajax.reload(null, false);
                        updateStats(response.stats);
                    }
                },
                error: function(xhr) {
                    Toast.fire({ icon: 'error', title: 'Une erreur est survenue lors de la mise à jour.' });
                },
                complete: function() {
                    updateBtn.prop('disabled', false).text('Mettre à jour');
                }
            });
        });

        // Suppression unitaire avec Toast au succès
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
                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            });
                            currentDt.ajax.reload(null, false);
                            updateStats(response.stats);
                        },
                        error: function(xhr) {
                            Toast.fire({ icon: 'error', title: 'Une erreur est survenue.' });
                        }
                    });
                }
            });
        });

        // Sélectionner toutes les lignes
        $(document).on('click', '#checkAllRows', function() {
            $('.check-row').prop('checked', $(this).prop('checked'));
        });

        // Suppression multiple avec Toast au succès
        $(document).on('click', '.delete-all', function() {
            var checkedCount = $('.check-row:checked').length;
            var url = $(this).attr('data-url');

            if (checkedCount < 1) {
                Swal.fire("Oups...", "Vous devez sélectionner au moins un don", "warning");
                return;
            }

            var all_id = [];
            $('.check-row:checked').each(function() {
                all_id.push($(this).val());
            });

            Swal.fire({
                title: "Êtes-vous sûr ?",
                text: "Vous allez supprimer " + checkedCount + " dons !",
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
                        data: { all_id: all_id },
                        success: function(response) {
                            if (response.status == true) {
                                Toast.fire({
                                    icon: 'success',
                                    title: response.message
                                });
                                currentDt.ajax.reload();
                                $('#checkAllRows').prop('checked', false);
                                updateStats(response.stats);
                            }
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
