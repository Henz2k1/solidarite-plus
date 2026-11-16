
@extends('admin.layouts.base')

@section('title', 'Modifier un événement')

@section('content')

<div class="container-fluid">

    {{-- En-tête --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">

                <div>
                    <h4 class="page-title">Modifier un événement</h4>

                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.analytics') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('events.index') }}">Événements</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Modifier
                        </li>
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
          action="{{ route('events.update', $event->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

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
                                   value="{{ old('title', $event->title) }}"
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
                                   value="{{ old('location', $event->location) }}"
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
                                       value="{{ old('start_date', $event->start_date?->format('Y-m-d\TH:i')) }}"
                                       required>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">
                                    Date de fin
                                </label>

                                <input type="datetime-local"
                                       class="form-control"
                                       id="end_date"
                                       name="end_date"
                                       value="{{ old('end_date', $event->end_date?->format('Y-m-d\TH:i')) }}">
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
                                      required>{{ old('description', $event->description) }}</textarea>
                        </div>

                    </div>
                </div>


                {{-- Galerie existante --}}
                <div class="card">
                    <div class="card-body">

                        <h5 class="mb-1">Galerie actuelle</h5>

                        <p class="text-muted">
                            Sélectionnez les photos que vous souhaitez supprimer.
                        </p>

                        <div class="row g-3">

                            @forelse($event->images as $image)

                                <div class="col-md-4 col-6">

                                    <div class="border rounded p-2 h-100"
                                         id="gallery-image-{{ $image->id }}">

                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($image->image) }}"
                                             alt="{{ $image->caption ?? 'Image de galerie' }}"
                                             class="img-fluid rounded mb-2"
                                             style="width:100%; height:130px; object-fit:cover;">

                                        <p class="small text-muted mb-2">
                                            {{ $image->caption ?? 'Sans légende' }}
                                        </p>

                                        <div class="form-check">
                                            <input class="form-check-input remove-image-checkbox"
                                                   type="checkbox"
                                                   name="remove_images[]"
                                                   value="{{ $image->id }}"
                                                   id="remove-image-{{ $image->id }}">

                                            <label class="form-check-label text-danger small"
                                                   for="remove-image-{{ $image->id }}">
                                                Supprimer cette photo
                                            </label>
                                        </div>

                                    </div>

                                </div>

                            @empty

                                <div class="col-12">
                                    <div class="alert alert-light border mb-0">
                                        Aucune photo supplémentaire dans cette galerie.
                                    </div>
                                </div>

                            @endforelse

                        </div>

                    </div>
                </div>


                {{-- Ajouter des images --}}
                <div class="card">
                    <div class="card-body">

                        <h5 class="mb-1">Ajouter des photos</h5>

                        <p class="text-muted">
                            Les nouvelles photos seront ajoutées à la galerie existante.
                        </p>

                        <div class="mb-3">

                            <label for="gallery_images" class="form-label">
                                Sélectionner les nouvelles photos
                            </label>

                            <input type="file"
                                   class="form-control"
                                   id="gallery_images"
                                   name="gallery_images[]"
                                   accept="image/jpeg,image/png,image/webp"
                                   multiple>

                            <small class="text-muted">
                                JPG, JPEG, PNG et WEBP. Maximum 4 Mo par image.
                            </small>

                        </div>

                        <div id="galleryPreview"
                             class="row g-3">
                        </div>

                    </div>
                </div>

            </div>


            {{-- Colonne latérale --}}
            <div class="col-lg-4">

                {{-- Publication --}}
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

                                <option value="draft"
                                    {{ old('status', $event->status) === 'draft' ? 'selected' : '' }}>
                                    Brouillon
                                </option>

                                <option value="published"
                                    {{ old('status', $event->status) === 'published' ? 'selected' : '' }}>
                                    Publié
                                </option>

                                <option value="archived"
                                    {{ old('status', $event->status) === 'archived' ? 'selected' : '' }}>
                                    Archivé
                                </option>

                            </select>

                        </div>

                        <small class="text-muted">
                            Choisissez la visibilité de votre événement.
                        </small>

                    </div>
                </div>


                {{-- Couverture --}}
                <div class="card">
                    <div class="card-body">

                        <h5 class="mb-3">Photo de couverture</h5>

                        <div class="border rounded p-2 text-center mb-3">

                            <img id="coverPreview"
                                 src="{{ \Illuminate\Support\Facades\Storage::url($event->image) }}"
                                 alt="Photo de couverture"
                                 class="img-fluid rounded"
                                 style="width:100%; max-height:220px; object-fit:cover;">

                        </div>

                        <label for="image" class="form-label">
                            Remplacer la couverture
                        </label>

                        <input type="file"
                               class="form-control"
                               id="image"
                               name="image"
                               accept="image/jpeg,image/png,image/webp">

                        <small class="text-muted">
                            Laissez vide pour conserver la couverture actuelle.
                            Maximum 4 Mo.
                        </small>

                    </div>
                </div>


                {{-- Actions --}}
                <div class="card">
                    <div class="card-body">

                        <button type="submit"
                                class="btn btn-primary w-100"
                                id="saveEventBtn">

                            <i class="mdi mdi-content-save me-1"></i>
                            Enregistrer les modifications

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

    // Aperçu de la nouvelle couverture
    $('#image').on('change', function () {

        const file = this.files[0];

        if (!file) {
            return;
        }

        const previewUrl = URL.createObjectURL(file);

        $('#coverPreview').attr('src', previewUrl);
    });


    // Aperçu des nouvelles photos de galerie
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
                               placeholder="Légende facultative">

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
            .html('<span class="spinner-border spinner-border-sm me-1"></span> Mise à jour...');

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
                    .html('<i class="mdi mdi-content-save me-1"></i> Enregistrer les modifications');

            }

        });

    });

});
</script>

@endpush
