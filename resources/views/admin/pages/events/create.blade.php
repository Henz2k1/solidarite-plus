
@extends('admin.layouts.base')

@section('title', 'Créer un événement')

@section('content')

<div class="container-fluid">

    {{-- Breadcrumb --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="page-title">Créer un événement</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.analytics') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('events.index') }}">Événements</a>
                        </li>
                        <li class="breadcrumb-item active">Créer</li>
                    </ol>
                </div>

                <a href="{{ route('events.index') }}"
                   class="btn btn-light">
                    <i class="mdi mdi-arrow-left me-1"></i>
                    Retour
                </a>
            </div>
        </div>
    </div>

    <form id="eventForm"
          action="{{ route('events.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="row">

            {{-- Informations générales --}}
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">

                        <h5 class="mb-3">Informations générales</h5>

                        <div class="mb-3">
                            <label for="title" class="form-label">
                                Titre de l'événement
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="title"
                                   name="title"
                                   placeholder="Ex : Journée de solidarité communautaire"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">
                                Lieu de l'événement
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="location"
                                   name="location"
                                   placeholder="Ex : Goma, RDC">
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">
                                    Date de début
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="datetime-local"
                                       class="form-control"
                                       id="start_date"
                                       name="start_date"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">
                                    Date de fin
                                </label>

                                <input type="datetime-local"
                                       class="form-control"
                                       id="end_date"
                                       name="end_date">
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                Description
                                <span class="text-danger">*</span>
                            </label>

                            <textarea class="form-control"
                                      id="description"
                                      name="description"
                                      rows="7"
                                      placeholder="Décrivez les objectifs, les activités et le déroulement de l'événement..."
                                      required></textarea>
                        </div>

                    </div>
                </div>

                {{-- Galerie --}}
                <div class="card">
                    <div class="card-body">

                        <h5 class="mb-1">Galerie de l'événement</h5>

                        <p class="text-muted">
                            Ajoutez plusieurs photos pour illustrer les activités.
                        </p>

                        <div class="mb-3">
                            <label for="gallery_images" class="form-label">
                                Sélectionner les photos
                            </label>

                            <input type="file"
                                   class="form-control"
                                   id="gallery_images"
                                   name="gallery_images[]"
                                   accept="image/jpeg,image/png,image/webp"
                                   multiple>

                            <small class="text-muted">
                                Formats acceptés : JPG, JPEG, PNG et WEBP.
                                Maximum 4 Mo par image.
                            </small>
                        </div>

                        <div id="galleryPreview"
                             class="row g-3">
                        </div>

                    </div>
                </div>

            </div>

            {{-- Paramètres et couverture --}}
            <div class="col-lg-4">

                {{-- Statut --}}
                <div class="card">
                    <div class="card-body">

                        <h5 class="mb-3">Publication</h5>

                        <div class="mb-3">
                            <label for="status" class="form-label">
                                Statut
                            </label>

                            <select class="form-select"
                                    name="status"
                                    id="status"
                                    required>

                                <option value="draft" selected>
                                    Brouillon
                                </option>

                                <option value="published">
                                    Publié
                                </option>

                                <option value="archived">
                                    Archivé
                                </option>

                            </select>
                        </div>

                        <small class="text-muted">
                            Un événement publié sera disponible sur le site public.
                        </small>

                    </div>
                </div>

                {{-- Couverture --}}
                <div class="card">
                    <div class="card-body">

                        <h5 class="mb-3">Photo de couverture</h5>

                        <div class="mb-3">

                            <div class="border rounded p-2 text-center mb-3">

                                <img id="coverPreview"
                                     src=""
                                     alt="Aperçu de la couverture"
                                     class="img-fluid rounded d-none"
                                     style="max-height: 220px; width: 100%; object-fit: cover;">

                                <div id="coverPlaceholder"
                                     class="py-5 text-muted">

                                    <i class="mdi mdi-image-outline"
                                       style="font-size: 48px;"></i>

                                    <p class="mb-0">
                                        Aperçu de la couverture
                                    </p>

                                </div>

                            </div>

                            <label for="image" class="form-label">
                                Choisir une image
                                <span class="text-danger">*</span>
                            </label>

                            <input type="file"
                                   class="form-control"
                                   id="image"
                                   name="image"
                                   accept="image/jpeg,image/png,image/webp"
                                   required>

                            <small class="text-muted">
                                JPG, JPEG, PNG ou WEBP. Maximum 4 Mo.
                            </small>

                        </div>

                    </div>
                </div>

                {{-- Actions --}}
                <div class="card">
                    <div class="card-body">

                        <button type="submit"
                                class="btn btn-primary w-100"
                                id="saveEventBtn">

                            <i class="mdi mdi-content-save me-1"></i>
                            Enregistrer l'événement

                        </button>

                        <a href="{{ route('events.index') }}"
                           class="btn btn-light w-100 mt-2">
                            Annuler
                        </a>

                    </div>
                </div>

            </div>

        </div>

    </form>

</div>

@endsection

@push('scripts')

<script>
$(document).ready(function () {

    // Aperçu de la couverture
    $('#image').on('change', function () {

        const file = this.files[0];

        if (!file) {
            $('#coverPreview').addClass('d-none');
            $('#coverPlaceholder').removeClass('d-none');
            return;
        }

        const previewUrl = URL.createObjectURL(file);

        $('#coverPreview')
            .attr('src', previewUrl)
            .removeClass('d-none');

        $('#coverPlaceholder').addClass('d-none');
    });


    // Aperçu de la galerie
    $('#gallery_images').on('change', function () {

        const files = Array.from(this.files);

        $('#galleryPreview').empty();

        files.forEach(function (file, index) {

            const previewUrl = URL.createObjectURL(file);

            const html = `
                <div class="col-md-4 col-6">
                    <div class="border rounded p-2 h-100">

                        <img src="${previewUrl}"
                             class="img-fluid rounded mb-2"
                             style="width:100%; height:120px; object-fit:cover;">

                        <input type="text"
                               class="form-control form-control-sm"
                               name="captions[${index}]"
                               placeholder="Légende (facultative)">

                        <small class="text-muted d-block mt-1">
                            ${file.name}
                        </small>

                    </div>
                </div>
            `;

            $('#galleryPreview').append(html);

        });

    });


    // Soumission AJAX
    $('#eventForm').on('submit', function (e) {

        e.preventDefault();

        const form = this;
        const formData = new FormData(form);

        const saveButton = $('#saveEventBtn');

        saveButton.prop('disabled', true)
            .html('<span class="spinner-border spinner-border-sm me-1"></span> Enregistrement...');

        $.ajax({

            url: $(form).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,

            success: function (response) {

                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: response.message,
                    confirmButtonText: 'Continuer'
                }).then(function () {

                    window.location.href = "{{ route('events.index') }}";

                });

            },

            error: function (xhr) {

                let message = 'Une erreur est survenue.';

                if (xhr.status === 422 && xhr.responseJSON.errors) {

                    message = Object.values(xhr.responseJSON.errors)
                        .flat()
                        .join('\n');

                } else if (xhr.responseJSON?.message) {

                    message = xhr.responseJSON.message;

                }

                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: message
                });

            },

            complete: function () {

                saveButton.prop('disabled', false)
                    .html('<i class="mdi mdi-content-save me-1"></i> Enregistrer l\'événement');

            }

        });

    });

});
</script>

@endpush
