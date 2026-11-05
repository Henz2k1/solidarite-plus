<div class="hero-wrap {{ $bgClass ?? 'bg-photo-1' }}" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row g-0 slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70% ' }">

                @isset($breadcrumb)
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                        <a href="{{ url('/') }}">Accueil</a> <span aria-hidden="true">/</span>
                        <span>{{ $breadcrumb }}</span>
                    </p>
                @endisset

                <h1 class="{{ isset($breadcrumb) ? 'mb-3 bread' : 'mb-4' }}"
                    data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                    {!! $title ?? 'Votre bien-être,<br>notre priorité.' !!}
                </h1>

                @isset($subtitle)
                    <p class="mb-5">{{ $subtitle }}</p>
                @endisset

                @if (!empty($buttonText) && !empty($buttonUrl))
                    <p><a href="{{ $buttonUrl }}"
                            class="btn btn-white btn-outline-white px-4 py-3">{{ $buttonText }}</a></p>
                @endif

            </div>
        </div>
    </div>
</div>
