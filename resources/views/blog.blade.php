@extends('layouts.app')

@section('title', 'Actualités & Analyses — SOLIDARITÉS PLUS RDC')

@section('content')

    <!-- Inclusion de la bannière spécifique à la page "Blog / Actualités" -->
    @include('partials.banner', [
        'bgClass' => 'bg-photo-2',
        'title' => 'Actualités &amp; Analyses',
        'subtitle' => 'Découvrez les actualités, histoires de terrain et analyses de SOLIDARITÉS PLUS.',
        'buttonText' => null,
        'buttonUrl' => null
    ])

    <div class="ed">

        <section class="ed-section">
            <div class="container">
                <header class="ed-heading">
                    <p class="ed-eyebrow">Le journal de terrain</p>
                    <h2>Un regard rapproché sur nos actions et nos engagements.</h2>
                </header>
                <div class="ed-grid">
                    <article class="ed-card ed-journal">
                        <a class="ed-card-image" href="{{ url('/article-volunteer-first-day') }}" tabindex="-1" aria-hidden="true">
                            <picture>
                                <source type="image/avif" srcset="{{ asset('images/bg_2-hd.avif') }}">
                                <img src="{{ asset('images/bg_2-hd.jpg') }}" alt="Accompagnement terrain SOLIDARITÉS PLUS" width="3840" height="2560" loading="lazy" decoding="async">
                            </picture>
                        </a>
                        <div class="ed-card-body">
                            <p class="ed-eyebrow">Notes de terrain</p>
                            <h3><a href="{{ url('/article-volunteer-first-day') }}">L'importance de l'écoute active auprès des survivantes</a></h3>
                            <p>Comment l'approche centrée sur la survivante garantit la confidentialité, la sécurité et la dignité sur le terrain.</p>
                            <a class="ed-text-link" href="{{ url('/article-volunteer-first-day') }}">Lire l'article<span aria-hidden="true">↗</span></a>
                        </div>
                    </article>

                    <article class="ed-card ed-journal">
                        <a class="ed-card-image" href="{{ url('/article-transparent-updates') }}" tabindex="-1" aria-hidden="true">
                            <picture>
                                <source type="image/avif" srcset="{{ asset('images/bg_5-hd.avif') }}">
                                <img src="{{ asset('images/bg_5-hd.jpg') }}" alt="Transparence et redevabilité humanitaire" width="3840" height="2560" loading="lazy" decoding="async">
                            </picture>
                        </a>
                        <div class="ed-card-body">
                            <p class="ed-eyebrow">Redevabilité</p>
                            <h3><a href="{{ url('/article-transparent-updates') }}">Transparence et efficience dans nos projets humanitaires</a></h3>
                            <p>Pourquoi des rapports de progression honnêtes et une gestion rigoureuse des ressources locales font toute la différence.</p>
                            <a class="ed-text-link" href="{{ url('/article-transparent-updates') }}">Lire l'article<span aria-hidden="true">↗</span></a>
                        </div>
                    </article>

                    <article class="ed-card ed-journal">
                        <a class="ed-card-image" href="{{ url('/article-help-without-money') }}" tabindex="-1" aria-hidden="true">
                            <picture>
                                <source type="image/avif" srcset="{{ asset('images/bg_6-hd.avif') }}">
                                <img src="{{ asset('images/bg_6-hd.jpg') }}" alt="Soutien communautaire" width="3840" height="2560" loading="lazy" decoding="async">
                            </picture>
                        </a>
                        <div class="ed-card-body">
                            <p class="ed-eyebrow">Communauté</p>
                            <h3><a href="{{ url('/article-help-without-money') }}">Cinq manières de soutenir l'autonomisation des vulnérables</a></h3>
                            <p>Temps, compétences pratiques et ancrage communautaire : comment chacun peut contribuer à sa mesure.</p>
                            <a class="ed-text-link" href="{{ url('/article-help-without-money') }}">Lire l'article<span aria-hidden="true">↗</span></a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Inclusion du composant CTA -->
        @include('partials.cta', [
            'eyebrow' => 'Une question ou un partenariat ?',
            'title' => 'Il y a plusieurs façons de s\'engager à nos côtés.',
            'description' => 'Partagez votre expertise, posez vos questions ou explorez un programme avec notre équipe.',
            'buttonText' => 'Commencer une conversation',
            'buttonUrl' => url('/contact'),
        ])

    </div> <!-- Fermeture du <div class="ed"> -->

@endsection
