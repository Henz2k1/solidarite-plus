@extends('layouts.app')

@section('title', 'SOLIDARITÉS PLUS RDC — Votre bien-être, notre priorité')

@section('content')

    <!-- Inclusion de la bannière spécifique à la page d'accueil -->
    @include('partials.banner', [
        'bgClass' => 'bg-photo-1',
        'title' => 'Votre bien-être,<br>notre priorité.',
        'subtitle' => 'Sauver des vies et alléger les souffrances des personnes vulnérables et des survivantes de VBG en RDC.',
        'buttonText' => 'Découvrir nos actions',
        'buttonUrl' => url('/causes')
    ])

    <div class="ed">
      <div class="container ed-home-support">
        <div class="ed-support-grid">
          <article>
            <p class="ed-eyebrow">Engagement local</p>
            <h2>Plus de 500 collaborateurs engagés.</h2>
            <a class="ed-text-link" href="{{ url('/volunteer') }}">Rejoindre nos équipes<span aria-hidden="true">↗</span></a>
          </article>
          <article>
            <p class="ed-eyebrow">Nos piliers</p>
            <h2>Prise en charge intégrée et protection.</h2>
            <a class="ed-text-link" href="{{ url('/causes') }}">Voir nos domaines d'intervention<span aria-hidden="true">↗</span></a>
          </article>
          <article>
            <p class="ed-eyebrow">Partenariat</p>
            <h2>Bâtir des actions durables et efficaces.</h2>
            <a class="ed-text-link" href="{{ url('/contact') }}">Devenir partenaire<span aria-hidden="true">↗</span></a>
          </article>
        </div>
      </div>

      <section class="ed-section ed-intro">
        <div class="container">
          <header class="ed-heading">
            <p class="ed-eyebrow">Engagement & Proximité</p>
            <h2>Protéger, accompagner et autonomiser les communautés.</h2>
          </header>
          <p class="ed-lead ed-max">Depuis 2003, SOLIDARITÉS PLUS a conduit plus de 50 projets mobilisant environ 1 million USD pour soutenir les femmes, les filles et les personnes déplacées internes.</p>
        </div>
      </section>

      <section class="ed-section">
        <div class="container">
          <header class="ed-heading">
            <p class="ed-eyebrow">Nos champs d'intervention</p>
            <h2>Des actions concrètes au service des populations</h2>
          </header>
          <div class="ed-grid">
            <article class="ed-card">
              <a href="{{ url('/cause-water') }}" class="ed-card-image" tabindex="-1" aria-hidden="true">
                <picture>
                  <source type="image/avif" srcset="{{ asset('images/bg_5-hd.avif') }}">
                  <img src="{{ asset('images/bg_5-hd.jpg') }}" alt="" width="3840" height="2560" loading="lazy" decoding="async">
                </picture>
              </a>
              <div class="ed-card-body">
                <p class="ed-eyebrow">Protection & Accompagnement</p>
                <h3><a href="{{ url('/cause-water') }}">Prise en charge intégrée des VBG</a></h3>
                <p>Assurer un soutien médical, psychosocial et juridique confidentiel et sécurisé aux survivantes de violences basées sur le genre.</p>
                <div class="ed-funding">
                  <div><span>50+ projets menés</span><span>1M$ investi</span></div>
                  <progress aria-label="Progression de nos programmes d'accompagnement VBG" value="85" max="100"></progress>
                  <small>Impact depuis 2003 en RDC et dans la région</small>
                </div>
                <a class="ed-text-link" href="{{ url('/cause-water') }}">En savoir plus <span aria-hidden="true">→</span></a>
              </div>
            </article>

            <article class="ed-card">
              <a href="{{ url('/cause-learning') }}" class="ed-card-image" tabindex="-1" aria-hidden="true">
                <picture>
                  <source type="image/avif" srcset="{{ asset('images/bg_6-hd.avif') }}">
                  <img src="{{ asset('images/bg_6-hd.jpg') }}" alt="" width="3840" height="2560" loading="lazy" decoding="async">
                </picture>
              </a>
              <div class="ed-card-body">
                <p class="ed-eyebrow">Santé Communautaire</p>
                <h3><a href="{{ url('/cause-learning') }}">Prévention VIH/SIDA & Santé Sexuelle</a></h3>
                <p>Promouvoir les droits sexuels et reproductifs et lutter contre la propagation du VIH/SIDA auprès des populations vulnérables.</p>
                <div class="ed-funding">
                  <div><span>Sensibilisation continue</span><span>Action de terrain</span></div>
                  <progress aria-label="Progression de nos programmes de santé" value="90" max="100"></progress>
                  <small>Interventions directes dans les zones à haut risque</small>
                </div>
                <a class="ed-text-link" href="{{ url('/cause-learning') }}">En savoir plus <span aria-hidden="true">→</span></a>
              </div>
            </article>

            <article class="ed-card">
              <a href="{{ url('/cause-pantry') }}" class="ed-card-image" tabindex="-1" aria-hidden="true">
                <picture>
                  <source type="image/avif" srcset="{{ asset('images/bg_7-hd.avif') }}">
                  <img src="{{ asset('images/bg_7-hd.jpg') }}" alt="" width="3840" height="2560" loading="lazy" decoding="async">
                </picture>
              </a>
              <div class="ed-card-body">
                <p class="ed-eyebrow">Autonomisation</p>
                <h3><a href="{{ url('/cause-pantry') }}">Renforcement socio-économique</a></h3>
                <p>Accompagner les survivantes et déplacés internes vers l'autonomie financière et une réintégration communautaire durable.</p>
                <div class="ed-funding">
                  <div><span>Développement durable</span><span>Impact local</span></div>
                  <progress aria-label="Progression de nos programmes d'autonomisation" value="75" max="100"></progress>
                  <small>Programmes de transition vers le développement</small>
                </div>
                <a class="ed-text-link" href="{{ url('/cause-pantry') }}">En savoir plus <span aria-hidden="true">→</span></a>
              </div>
            </article>
          </div>
        </div>
      </section>

      <section class="ed-section ed-feature" id="about-section">
        <div class="container ed-split">
          <div class="ed-feature-image">
            <picture>
              <source type="image/avif" srcset="{{ asset('images/bg_2-hd.avif') }}">
              <img src="{{ asset('images/bg_2-hd.jpg') }}" alt="Photographie des programmes communautaires SOLIDARITÉS PLUS" width="3840" height="2560" loading="lazy" decoding="async">
            </picture>
          </div>
          <div>
            <p class="ed-eyebrow">Notre Approche</p>
            <h2>L'Approche Centrée sur la Survivante (ACS).</h2>
            <p class="ed-lead">Dans des contextes complexes comme Rutshuru, Goma et Drodro (Ituri), nous garantissons la confidentialité, la sécurité et la dignité des personnes tout en leur facilitant l'accès aux services essentiels.</p>
            <a class="ed-button" href="{{ url('/about') }}">En savoir plus sur nous<span aria-hidden="true">↗</span></a>
          </div>
        </div>
      </section>

      <section class="ed-section ed-pale" id="services-section">
        <div class="container">
          <header class="ed-heading">
            <p class="ed-eyebrow">Nos piliers stratégiques</p>
            <h2>Principes opérationnels et valeur ajoutée.</h2>
          </header>
          <div class="ed-grid">
            <article class="ed-service">
              <span class="ed-step-number">01</span>
              <h3>Écoute et ancrage communautaire</h3>
              <p>Comprendre les besoins réels et les dynamiques sociales dès le premier jour pour des interventions pertinentes et adaptées.</p>
              <a class="ed-text-link" href="{{ url('/volunteer') }}">Découvrir l'approche<span aria-hidden="true">↗</span></a>
            </article>
            <article class="ed-service">
              <span class="ed-step-number">02</span>
              <h3>Confiance et redevabilité</h3>
              <p>Instaurer un dialogue continu avec les populations affectées pour garantir la transparence et l'appropriation locale.</p>
              <a class="ed-text-link" href="{{ url('/donate') }}">En savoir plus<span aria-hidden="true">↗</span></a>
            </article>
            <article class="ed-service">
              <span class="ed-step-number">03</span>
              <h3>Exécution directe et efficience</h3>
              <p>Mobiliser le personnel et les ressources locales pour réduire les coûts intermédiaires et optimiser l'utilisation des fonds.</p>
              <a class="ed-text-link" href="{{ url('/contact') }}">Nous contacter<span aria-hidden="true">↗</span></a>
            </article>
          </div>
        </div>
      </section>

      <section class="ed-section ed-pale">
        <div class="container">
          <header class="ed-heading">
            <p class="ed-eyebrow">Méthodologie d'intervention</p>
            <h2>Un parcours structuré pour un impact durable.</h2>
          </header>
          <ol class="ed-steps">
            <li>
              <span class="ed-step-number">01</span>
              <h3>Écouter</h3>
              <p>Identifier les pratiques locales et évaluer les besoins prioritaires avec les autorités et acteurs communautaires.</p>
            </li>
            <li>
              <span class="ed-step-number">02</span>
              <h3>Planifier</h3>
              <p>Co-construire des projets à portée claire avec un budget transparent et adapté aux réalités du terrain.</p>
            </li>
            <li>
              <span class="ed-step-number">03</span>
              <h3>Exécuter</h3>
              <p>Mettre en œuvre les actions via notre modèle d'exécution directe et notre réseau d'accès aux zones difficiles.</p>
            </li>
            <li>
              <span class="ed-step-number">04</span>
              <h3>Pérenniser</h3>
              <p>Renforcer les capacités institutionnelles et locales pour assurer l'autonomie et la continuité au-delà des financements.</p>
            </li>
          </ol>
        </div>
      </section>

      <section class="ed-section" id="blog-section">
        <div class="container">
          <header class="ed-heading">
            <p class="ed-eyebrow">Dernières actualités</p>
            <h2>Nouvelles du terrain et témoignages.</h2>
          </header>
          <div class="ed-grid">
            <article class="ed-card ed-journal">
              <a class="ed-card-image" href="#" tabindex="-1" aria-hidden="true">
                <picture>
                  <source type="image/avif" srcset="{{ asset('images/bg_2-hd.avif') }}">
                  <img src="{{ asset('images/bg_2-hd.jpg') }}" alt="" width="3840" height="2560" loading="lazy" decoding="async">
                </picture>
              </a>
              <div class="ed-card-body">
                <p class="ed-eyebrow">Notes du terrain</p>
                <h3><a href="#">L'Approche Centrée sur la Survivante à Rutshuru et Goma</a></h3>
                <p>Comment préserver la dignité, la sécurité et la confidentialité lors des interventions complexes en RDC.</p>
                <a class="ed-text-link" href="#">Lire l'article<span aria-hidden="true">↗</span></a>
              </div>
            </article>

            <article class="ed-card ed-journal">
              <a class="ed-card-image" href="#" tabindex="-1" aria-hidden="true">
                <picture>
                  <source type="image/avif" srcset="{{ asset('images/bg_5-hd.avif') }}">
                  <img src="{{ asset('images/bg_5-hd.jpg') }}" alt="" width="3840" height="2560" loading="lazy" decoding="async">
                </picture>
              </a>
              <div class="ed-card-body">
                <p class="ed-eyebrow">Redevabilité</p>
                <h3><a href="#">Bilan de nos 50 projets et plus de 20 ans d'impact</a></h3>
                <p>Retour sur notre présence continue auprès des survivantes de VBG et des déplacés internes.</p>
                <a class="ed-text-link" href="#">Lire l'article<span aria-hidden="true">↗</span></a>
              </div>
            </article>

            <article class="ed-card ed-journal">
              <a class="ed-card-image" href="#" tabindex="-1" aria-hidden="true">
                <picture>
                  <source type="image/avif" srcset="{{ asset('images/bg_6-hd.avif') }}">
                  <img src="{{ asset('images/bg_6-hd.jpg') }}" alt="" width="3840" height="2560" loading="lazy" decoding="async">
                </picture>
              </a>
              <div class="ed-card-body">
                <p class="ed-eyebrow">Communauté</p>
                <h3><a href="#">Autonomisation socio-économique des femmes en RDC</a></h3>
                <p>Les leviers essentiels pour accompagner le passage de l'aide d'urgence au développement durable.</p>
                <a class="ed-text-link" href="#">Lire l'article<span aria-hidden="true">↗</span></a>
              </div>
            </article>
          </div>
        </div>
      </section>

     <!-- Inclusion du composant CTA pour la page d'accueil -->
      @include('partials.cta', [
          'eyebrow' => 'Rejoignez-nous',
          'title' => 'Ensemble pour faire la différence.',
          'description' => 'Soutenez nos actions de protection, devenez partenaire ou échangez avec nos équipes sur le terrain.',
          'buttonText' => 'Engager la conversation',
          'buttonUrl' => url('/contact')
      ])

    </div> <!-- Fermeture du <div class="ed"> -->
</div> <!-- Fermeture optionnelle si un conteneur parent restait ouvert -->

@endsection
