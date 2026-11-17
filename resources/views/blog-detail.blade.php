@extends('layouts.app')

@section('title', ($article->title ?? 'Ce que comprend un suivi de projet utile') . ' — SOLIDARITÉS PLUS RDC')

@section('content')

    <!-- Inclusion de la bannière spécifique à la page d'article -->
    @include('partials.banner', [
        'bgClass' => 'bg-photo-1',
        'title' => $article->title ?? 'Ce que comprend un suivi de projet utile',
        'subtitle' => 'Des budgets clairs et des notes de progrès honnêtes sont plus utiles qu\'un simple chiffre choc.',
        'buttonText' => null,
        'buttonUrl' => null
    ])

    <div class="ed">
        <section class="ed-section">
            <div class="container ed-reading-layout">

                <!-- Corps principal de l'article -->
                <article class="ed-reading">
                    <p class="ed-eyebrow">{{ $article->eyebrow ?? 'Redevabilité humanitaire' }}</p>
                    <p class="ed-lead">
                        {{ $article->lead ?? 'Des budgets transparents et des notes de terrain honnêtes sont indispensables pour bâtir une relation de confiance durable avec les communautés et nos partenaires.' }}
                    </p>

                    <picture>
                        <source type="image/avif" srcset="{{ asset('images/bg_5-hd.avif') }}">
                        <img class="ed-reading-image" src="{{ asset('images/bg_5-hd.jpg') }}" alt="Suivi de projet et transparence sur le terrain" width="3840" height="2560" loading="lazy" decoding="async">
                    </picture>

                    <section>
                        <h2>Expliquer le travail effectué</h2>
                        <p>Un rapport d'activité doit exposer clairement ce qui était prévu, ce qui s'est réellement produit sur le terrain et les facteurs d'ajustement. Un retard ou une réorientation de programme mérite la même transparence qu'une réussite majeure.</p>
                    </section>

                    <section>
                        <h2>Montrer l'allocation des ressources</h2>
                        <p>Regrouper les coûts de manière lisible pour que chaque donateur et membre de la communauté comprenne l'impact. Mettre en valeur les achats locaux, la logistique de transport, la maintenance et l'engagement des équipes locales qui portent le projet au quotidien.</p>
                    </section>

                    <section>
                        <h2>Partager les perspectives et apprentissages</h2>
                        <p>Un reporting utile permet à l'organisation d'apprendre et de s'améliorer. Décrire les retours d'expérience recueillis auprès des bénéficiaires, la prochaine décision opérationnelle et la date prévisionnelle du prochain point d'étape.</p>
                    </section>

                    <p class="ed-note">Article de sensibilisation et de redevabilité — SOLIDARITÉS PLUS RDC.</p>
                    <a class="ed-text-link" href="{{ url('/blog') }}">← Retour aux actualités et analyses<span aria-hidden="true">↗</span></a>
                </article>

                <!-- Barre latérale (Sidebar) pour explorer d'autres articles -->
                <aside class="ed-aside">
                    <h2>Continuer la lecture</h2>
                    <a class="ed-related" href="{{ url('/article-volunteer-first-day') }}">L'importance de l'écoute active auprès des survivantes<span aria-hidden="true">↗</span></a>
                    <a class="ed-related" href="{{ url('/article-help-without-money') }}">Cinq manières de soutenir l'autonomisation des vulnérables<span aria-hidden="true">↗</span></a>
                    <a class="ed-text-link" href="{{ url('/contact') }}">Commencer une conversation<span aria-hidden="true">↗</span></a>
                </aside>

            </div>
        </section>
    </div>

@endsection
