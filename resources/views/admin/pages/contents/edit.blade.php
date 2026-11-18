
@extends('admin.layouts.base')

@section('title', 'Modifier le Contenu - ' . config('app.name'))

@section('content')

<div class="container-fluid">

    {{-- En-tête --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Modifier le contenu</h4>

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
                            Modification
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Formulaire --}}
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Informations du contenu</h4>
                </div>

                <div class="card-body">

                    <form id="contentForm"
                          action="{{ route('contents.update', $content->id) }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        {{-- Clé unique --}}
                        <div class="mb-3">
                            <label for="content_key" class="form-label">
                                Clé du contenu
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="content_key"
                                id="content_key"
                                class="form-control"
                                value="{{ old('content_key', $content->content_key) }}"
                                maxlength="150"
                                required>

                            <small class="text-muted">
                                Exemple : about.domains.description
                            </small>
                        </div>

                        {{-- Type --}}
                        <div class="mb-3">
                            <label for="type" class="form-label">
                                Type de contenu
                                <span class="text-danger">*</span>
                            </label>

                            <select name="type" id="type" class="form-select" required>
                                <option value="text"
                                    @selected(old('type', $content->type) === 'text')>
                                    Texte court
                                </option>

                                <option value="html"
                                    @selected(old('type', $content->type) === 'html')>
                                    Texte long / HTML
                                </option>

                                <option value="image"
                                    @selected(old('type', $content->type) === 'image')>
                                    Image
                                </option>

                                <option value="url"
                                    @selected(old('type', $content->type) === 'url')>
                                    URL / Lien
                                </option>

                                <option value="number"
                                    @selected(old('type', $content->type) === 'number')>
                                    Nombre
                                </option>
                            </select>
                        </div>

                        {{-- Valeur textuelle --}}
                        <div class="mb-3" id="text-value-container">

                            <label for="content_value" class="form-label">
                                Valeur du contenu
                            </label>

                            <textarea
                                name="content_value"
                                id="content_value"
                                class="form-control"
                                rows="5"
                                placeholder="Entrez la valeur du contenu...">{{ old('content_value', $content->type !== 'image' ? $content->content_value : '') }}</textarea>

                        </div>

                        {{-- Image --}}
                        <div class="mb-3 d-none" id="image-value-container">

                            <label for="image_file" class="form-label">
                                Nouvelle image
                            </label>

                            <input
                                type="file"
                                name="image_file"
                                id="image_file"
                                class="form-control"
                                accept="image/jpeg,image/png,image/jpg,image/webp">

                            <small class="text-muted">
                                Formats acceptés : JPG, JPEG, PNG et WEBP.
                                Taille maximale : 2 Mo.
                            </small>

                            {{-- Image actuelle --}}
                            @if($content->type === 'image' && $content->content_value)

                                <div class="mt-3" id="existing-image-container">

                                    <p class="text-muted fw-bold">
                                        Image actuelle :
                                    </p>

                                    <img
                                        src="{{ asset('storage/' . $content->content_value) }}"
                                        alt="Image actuelle"
                                        class="img-thumbnail"
                                        style="max-height: 180px;">

                                </div>

                            @endif

                            {{-- Aperçu nouvelle image --}}
                            <div class="mt-3 d-none" id="new-image-preview-container">

                                <p class="text-success fw-bold">
                                    Nouvelle image sélectionnée :
                                </p>

                                <img
                                    id="image-preview"
                                    src="#"
                                    alt="Aperçu"
                                    class="img-thumbnail"
                                    style="max-height: 180px;">

                            </div>

                        </div>

                        {{-- Page --}}
                        <div class="mb-3">
                            <label for="page" class="form-label">
                                Page associée
                            </label>

                            <input
                                type="text"
                                name="page"
                                id="page"
                                class="form-control"
                                value="{{ old('page', $content->page) }}"
                                maxlength="50"
                                placeholder="Exemple : about">
                        </div>

                        {{-- Statut --}}
                        <div class="form-check form-switch mb-3">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                class="form-check-input"
                                id="is_active"
                                @checked(old('is_active', $content->is_active))>

                            <label class="form-check-label fw-bold" for="is_active">
                                Contenu actif
                            </label>

                        </div>

                        <hr>

                        {{-- Boutons --}}
                        <div class="d-flex justify-content-between">

                            <a href="{{ route('contents.index') }}"
                               class="btn btn-secondary">

                                <i class="mdi mdi-arrow-left me-1"></i>
                                Retour

                            </a>

                            <button type="submit"
                                    class="btn btn-primary"
                                    id="submitBtn">

                                <i class="mdi mdi-content-save me-1"></i>
                                Enregistrer les modifications

                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection


@push('scripts')

<script>
$(document).ready(function() {

    // ==========================================
    // AFFICHAGE SELON LE TYPE
    // ==========================================

    function toggleInputType() {

        const selectedType = $('#type').val();

        if (selectedType === 'image') {

            $('#text-value-container').addClass('d-none');

            $('#image-value-container').removeClass('d-none');

            $('#content_value').prop('disabled', true);

        } else {

            $('#text-value-container').removeClass('d-none');

            $('#image-value-container').addClass('d-none');

            $('#content_value').prop('disabled', false);

            $('#image_file').val('');

            $('#new-image-preview-container').addClass('d-none');
        }
    }

    $('#type').on('change', toggleInputType);

    toggleInputType();


    // ==========================================
    // APERÇU DE LA NOUVELLE IMAGE
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
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {

            Swal.fire(
                'Format non autorisé',
                'Veuillez sélectionner une image JPG, PNG ou WEBP.',
                'warning'
            );

            $(this).val('');

            return;
        }

        if (file.size > 2 * 1024 * 1024) {

            Swal.fire(
                'Fichier trop volumineux',
                'La taille maximale autorisée est de 2 Mo.',
                'warning'
            );

            $(this).val('');

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
    // SOUMISSION AJAX
    // ==========================================

    $('#contentForm').on('submit', function(e) {

        e.preventDefault();

        const form = this;

        const formData = new FormData(form);

        const submitBtn = $('#submitBtn');

        const originalText = submitBtn.html();

        $.ajax({

            url: $(form).attr('action'),

            type: 'POST',

            data: formData,

            processData: false,

            contentType: false,

            beforeSend: function() {

                submitBtn
                    .prop('disabled', true)
                    .html(
                        '<span class="spinner-border spinner-border-sm me-1"></span> Modification...'
                    );

            },

            success: function(response) {

                if (response.status === true) {

                    Swal.fire({

                        title: 'Succès !',

                        text: response.message,

                        icon: 'success',

                        confirmButtonColor: '#1abc9c',

                        confirmButtonText: 'OK'

                    }).then(() => {

                        window.location.href = "{{ route('contents.index') }}";

                    });

                } else {

                    Swal.fire(
                        'Attention',
                        response.message ?? 'La modification a échoué.',
                        'warning'
                    );

                    submitBtn
                        .prop('disabled', false)
                        .html(originalText);

                }

            },

            error: function(xhr) {

                submitBtn
                    .prop('disabled', false)
                    .html(originalText);

                if (xhr.status === 422) {

                    const errors = xhr.responseJSON.errors;

                    let message = '';

                    $.each(errors, function(key, value) {

                        message += value[0] + '<br>';

                    });

                    Swal.fire({

                        title: 'Erreur de validation',

                        html: message,

                        icon: 'error'

                    });

                } else {

                    Swal.fire({

                        title: 'Erreur',

                        text: xhr.responseJSON?.message
                            ?? 'Une erreur est survenue lors de la modification.',

                        icon: 'error'

                    });

                }

            }

        });

    });

});
</script>

@endpush
