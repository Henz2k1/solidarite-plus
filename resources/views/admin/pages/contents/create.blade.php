
@extends('admin.layouts.base')

@section('title', isset($content) ? 'Modifier le Contenu - ' . env('APP_NAME') : 'Ajouter un Contenu - ' . env('APP_NAME'))

@section('content')

    {{-- En-tête de la page --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">
                    {{ isset($content) ? 'Modifier le contenu' : 'Ajouter un nouveau contenu' }}
                </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.analytics') }}">
                                Tableau de Bord
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('contents.index') }}">
                                Gestion des Contenus
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            {{ isset($content) ? 'Édition' : 'Création' }}
                        </li>

                    </ol>
                </div>

            </div>
        </div>
    </div>


    {{-- Formulaire de contenu --}}
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">

                    <form
                        id="contentForm"
                        action="{{ isset($content) ? route('contents.update', $content->id) : route('contents.store') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        @if(isset($content))
                            @method('PUT')
                        @endif


                        {{-- Informations générales --}}
                        <h5 class="mb-3">
                            Informations générales
                        </h5>

                        <div class="row">

                            {{-- Clé unique --}}
                            <div class="col-md-6 mb-3">

                                <label for="content_key" class="form-label">
                                    Clé unique
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="content_key"
                                    name="content_key"
                                    value="{{ old('content_key', $content->content_key ?? '') }}"
                                    placeholder="ex: about.mission.title"
                                    maxlength="150"
                                    required>

                                <small class="text-muted">
                                    Identifiant utilisé pour récupérer le contenu dans les vues Blade.
                                </small>

                            </div>


                            {{-- Page associée --}}
                            <div class="col-md-6 mb-3">

                                <label for="page" class="form-label">
                                    Page associée
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="page"
                                    name="page"
                                    value="{{ old('page', $content->page ?? '') }}"
                                    placeholder="ex: home, about, contact"
                                    maxlength="50">

                                <small class="text-muted">
                                    Laissez vide si le contenu est global.
                                </small>

                            </div>

                        </div>


                        <div class="row">

                            {{-- Type de contenu --}}
                            <div class="col-md-6 mb-3">

                                <label for="type" class="form-label">
                                    Type de contenu
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    class="form-select"
                                    id="type"
                                    name="type"
                                    required>

                                    <option value="">Sélectionner un type</option>

                                    <option value="text"
                                        {{ old('type', $content->type ?? 'text') === 'text' ? 'selected' : '' }}>
                                        Texte court
                                    </option>

                                    <option value="html"
                                        {{ old('type', $content->type ?? '') === 'html' ? 'selected' : '' }}>
                                        Texte long / HTML
                                    </option>

                                    <option value="image"
                                        {{ old('type', $content->type ?? '') === 'image' ? 'selected' : '' }}>
                                        Image
                                    </option>

                                    <option value="url"
                                        {{ old('type', $content->type ?? '') === 'url' ? 'selected' : '' }}>
                                        URL / Lien
                                    </option>

                                    <option value="number"
                                        {{ old('type', $content->type ?? '') === 'number' ? 'selected' : '' }}>
                                        Nombre
                                    </option>

                                </select>

                            </div>


                            {{-- Statut --}}
                            <div class="col-md-6 mb-3 d-flex align-items-center">

                                <div class="form-check form-switch mt-3">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="is_active"
                                        name="is_active"
                                        value="1"
                                        {{ old('is_active', $content->is_active ?? true) ? 'checked' : '' }}>

                                    <label
                                        class="form-check-label fw-bold"
                                        for="is_active">

                                        Activer ce contenu

                                    </label>

                                </div>

                            </div>

                        </div>


                        <hr class="my-3">


                        {{-- Valeur textuelle --}}
                        <div class="mb-3" id="text-value-container">

                            <label for="content_value" class="form-label">
                                Valeur du contenu
                                <span class="text-danger">*</span>
                            </label>

                            <textarea
                                class="form-control"
                                id="content_value"
                                name="content_value"
                                rows="6"
                                placeholder="Entrez le texte ou la valeur ici...">{{ old('content_value', isset($content) && $content->type !== 'image' ? $content->content_value : '') }}</textarea>

                            <small class="text-muted">
                                Saisissez le contenu qui sera affiché sur le site.
                            </small>

                        </div>


                        {{-- Valeur image --}}
                        <div class="mb-3 d-none" id="image-value-container">

                            <label for="image_file" class="form-label">
                                Fichier image
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="file"
                                class="form-control"
                                id="image_file"
                                name="image_file"
                                accept="image/jpeg,image/png,image/jpg,image/svg+xml,image/webp">

                            <small class="text-muted">
                                Formats acceptés : JPG, JPEG, PNG, SVG et WEBP.
                                Taille maximale recommandée : 2 Mo.
                            </small>


                            {{-- Image existante --}}
                            <div class="mt-3">

                                <div
                                    id="existing-image-container"
                                    class="{{ isset($content) && $content->type === 'image' && $content->content_value ? '' : 'd-none' }}">

                                    <p class="mb-1 text-muted small fw-bold">
                                        Image actuelle :
                                    </p>

                                    <img
                                        id="existing-image-preview"
                                        src="{{ isset($content) && $content->content_value ? asset($content->content_value) : '#' }}"
                                        alt="Image actuelle"
                                        class="img-thumbnail"
                                        style="max-height: 150px;">

                                </div>


                                {{-- Aperçu nouvelle image --}}
                                <div id="new-image-preview-container" class="d-none mt-3">

                                    <p class="mb-1 text-success small fw-bold">
                                        Nouvelle image sélectionnée :
                                    </p>

                                    <img
                                        id="image-preview"
                                        src="#"
                                        alt="Aperçu de la nouvelle image"
                                        class="img-thumbnail border-success"
                                        style="max-height: 150px;">

                                </div>

                            </div>

                        </div>


                        {{-- Boutons --}}
                        <hr class="my-3">

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('contents.index') }}"
                                class="btn btn-secondary">

                                <i class="mdi mdi-arrow-left me-1"></i>
                                Retour

                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary"
                                id="submitBtn">

                                <i class="mdi mdi-content-save me-1"></i>

                                {{ isset($content) ? 'Mettre à jour' : 'Enregistrer' }}

                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection


@push('scripts')

<script>
    $(document).ready(function() {

        const isEditing = {{ isset($content) ? 'true' : 'false' }};

        const hasExistingImage = {{ isset($content) && $content->type === 'image' && $content->content_value ? 'true' : 'false' }};


        // ==========================================
        // AFFICHAGE SELON LE TYPE DE CONTENU
        // ==========================================

        function toggleInputType() {

            const selectedType = $('#type').val();

            if (selectedType === 'image') {

                $('#text-value-container').addClass('d-none');

                $('#image-value-container').removeClass('d-none');

                $('#content_value').prop('disabled', true);

                $('#image_file').prop(
                    'required',
                    !isEditing || !hasExistingImage
                );

            } else {

                $('#text-value-container').removeClass('d-none');

                $('#image-value-container').addClass('d-none');

                $('#content_value').prop('disabled', false);

                $('#image_file')
                    .prop('required', false)
                    .val('');

                $('#new-image-preview-container').addClass('d-none');

            }
        }


        $('#type').on('change', toggleInputType);

        toggleInputType();


        // ==========================================
        // APERÇU DE L'IMAGE
        // ==========================================

        $('#image_file').on('change', function(event) {

            const file = event.target.files[0];

            if (!file) {

                $('#new-image-preview-container').addClass('d-none');

                return;
            }

            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/svg+xml',
                'image/webp'
            ];

            if (!allowedTypes.includes(file.type)) {

                Swal.fire(
                    'Format non autorisé',
                    'Veuillez sélectionner une image JPG, PNG, SVG ou WEBP.',
                    'warning'
                );

                $(this).val('');

                $('#new-image-preview-container').addClass('d-none');

                return;
            }

            if (file.size > 2 * 1024 * 1024) {

                Swal.fire(
                    'Fichier trop volumineux',
                    'La taille de l’image ne doit pas dépasser 2 Mo.',
                    'warning'
                );

                $(this).val('');

                $('#new-image-preview-container').addClass('d-none');

                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {

                $('#image-preview').attr('src', e.target.result);

                $('#new-image-preview-container').removeClass('d-none');

            };

            reader.readAsDataURL(file);

        });


        // ==========================================
        // SOUMISSION AJAX DU FORMULAIRE
        // ==========================================

        $('#contentForm').on('submit', function(e) {

            e.preventDefault();

            const form = this;

            const formData = new FormData(form);

            const url = $(form).attr('action');

            const submitBtn = $('#submitBtn');

            const originalButtonText = submitBtn.html();


            $.ajax({

                url: url,

                type: 'POST',

                data: formData,

                processData: false,

                contentType: false,


                beforeSend: function() {

                    submitBtn
                        .prop('disabled', true)
                        .html(
                            '<span class="spinner-border spinner-border-sm me-1" role="status"></span> Enregistrement...'
                        );

                },


                success: function(response) {

                    if (response.status) {

                        Swal.fire({

                            title: 'Succès !',

                            text: response.message,

                            icon: 'success',

                            confirmButtonColor: '#1abc9c'

                        }).then(() => {

                            window.location.href = "{{ route('contents.index') }}";

                        });

                    }

                },


                error: function(xhr) {

                    submitBtn
                        .prop('disabled', false)
                        .html(originalButtonText);


                    if (xhr.status === 422) {

                        const errors = xhr.responseJSON.errors;

                        let errorMessage = '';

                        $.each(errors, function(key, value) {

                            errorMessage += value[0] + '<br>';

                        });

                        Swal.fire({

                            title: 'Erreur de validation',

                            html: errorMessage,

                            icon: 'error'

                        });

                    } else {

                        const message = xhr.responseJSON?.message
                            ?? 'Une erreur est survenue lors de l’enregistrement.';

                        Swal.fire({

                            title: 'Erreur',

                            text: message,

                            icon: 'error'

                        });

                    }

                }

            });

        });

    });
</script>

@endpush
