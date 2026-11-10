@extends('layouts.app')

@section('title', 'À propos de SOLIDARITÉS PLUS — SOLIDARITÉS PLUS')
@section('meta_description',
    'SOLIDARITÉS PLUS est une organisation non gouvernementale engagée depuis 2003 dans la
    protection des survivantes de VBG, la lutte contre le VIH/SIDA et l\'autonomie socio-économique des populations
    vulnérables en RDC.')

@section('content')

    <!-- Inclusion de la bannière spécifique à la page À propos -->
    @include('partials.banner', [
        'bgClass' => 'bg-photo-1',
        'title' => 'À propos de SOLIDARITÉS PLUS',
        'subtitle' =>
            'Sauver des vies et alléger les souffrances des personnes vulnérables et des survivantes de VBG depuis 2003.',
    ])

    <div class="ed">

        <!-- Section À propos de nous / Présentation Institutionnelle -->
        <section class="ed-section ed-about-detailed" id="about-us-section">
            <div class="container">
                <header class="ed-heading">
                    <p class="ed-eyebrow">Qui sommes-nous ?</p>
                    <h2>Solidarités Plus RDC (SOLIPLUS)</h2>
                </header>

                <div class="ed-lead ed-max" style="margin-bottom: 2rem;">
                    <p style="font-size: 16px;">
                        Créée le 6 janvier 2003 à Bukavu et basée à Goma (Province du Nord-Kivu), <strong>Solidarités Plus
                            RDC (SOLIPLUS)</strong> est une organisation non gouvernementale (ONG) nationale de droit
                        congolais, sans but lucratif. Depuis plus de deux décennies, nous œuvrons sans relâche dans l'est de
                        la République Démocratique du Congo pour renforcer les communautés touchées par les conflits et la
                        pauvreté.
                    </p>
                </div>

                <div class="ed-grid" style="margin-bottom: 3rem;">
                    <article class="ed-card">
                        <div class="ed-card-body">
                            <h3>Notre Mission</h3>
                            <p>Sauver des vies et alléger les souffrances des personnes les plus vulnérables en s'attaquant
                                aux causes sous-jacentes de la pauvreté, afin de les rendre autonomes et capables de
                                réaliser leur plein potentiel. Nous plaçons au cœur de nos actions la protection intégrée
                                des survivantes de violences basées sur le genre (VBG).</p>
                        </div>
                    </article>

                    <article class="ed-card">
                        <div class="ed-card-body">
                            <h3>Notre Vision</h3>
                            <p>Bâtir un environnement stable doté de solutions durables qui profitent directement aux
                                populations dans le besoin. Nous donnons aux communautés les moyens de devenir
                                autosuffisantes tout en favorisant des changements culturels constructifs et acceptés au
                                niveau local.</p>
                        </div>
                    </article>

                    <article class="ed-card">
                        <div class="ed-card-body">
                            <h3>Nos Domaines Clés</h3>
                            <p>Prise en charge intégrée des survivantes de VBG (femmes et filles), lutte contre le VIH/SIDA,
                                promotion des droits sexuels et reproductifs (SDSR), éducation communautaire et
                                autonomisation socio-économique.</p>
                        </div>
                    </article>
                </div>

                <!-- Encadré informatif sur l'ancrage et la gouvernance -->
                <div class="ed-feature p-4 bg-light rounded" style="border-left: 4px solid var(--bs-primary, #f86f2d);">
                    <h3>Ancrage et Approche de Terrain</h3>
                    <p>
                        Face aux crises humanitaires complexes de l'Est de la RDC, SOLIPLUS s'appuie sur une
                        <strong>exécution directe</strong> et un dialogue communautaire permanent pour garantir la
                        redevabilité, la dignité et la pérennité des actions menées sur le terrain.
                    </p>
                </div>
            </div>
        </section>

        <section class="ed-section ed-feature" id="about-section">
            <div class="container ed-split">
                <div class="ed-feature-image">
                    <picture>
                        <source type="image/avif" srcset="{{ asset('images/bg_2-hd.avif') }}">
                        <img src="{{ asset('images/bg_2-hd.jpg') }}" alt="Accompagnement communautaire SOLIDARITÉS PLUS"
                            width="3840" height="2560" loading="lazy" decoding="async">
                    </picture>
                </div>
                <div>
                    <p class="ed-eyebrow">Notre priorité : Sauver des vies et alléger les souffrances.</p>
                    <h2>Agir aux côtés des personnes vulnérables et des survivantes de VBG.</h2>
                    <p class="ed-lead">SOLIDARITÉS PLUS est engagée dans la protection et l'accompagnement intégrés des
                        survivantes de violences basées sur le genre (en particulier les femmes et les filles), la lutte
                        contre le VIH/SIDA et le renforcement de l'autonomie socio-économique.</p>
                    <a class="ed-button" href="{{ url('/contact') }}">Découvrir notre mission<span
                            aria-hidden="true">↗</span></a>
                </div>
            </div>
        </section>

        <section class="ed-section ed-pale">
            <div class="container">
                <header class="ed-heading">
                    <p class="ed-eyebrow">Nos champs d'intervention</p>
                    <h2>Une action globale ancrée dans les communautés.</h2>
                </header>
                <div class="ed-grid">
                    <article class="ed-service">
                        <span class="ed-step-number">01</span>
                        <h3>Protection & VBG</h3>
                        <p>Protection et accompagnement intégré des survivantes de VBG (femmes et filles) avec un appui
                            fondé sur la confidentialité et la dignité.</p>
                        <a class="ed-text-link" href="{{ url('/causes') }}">En savoir plus<span
                                aria-hidden="true">↗</span></a>
                    </article>
                    <article class="ed-service">
                        <span class="ed-step-number">02</span>
                        <h3>Santé & Droits</h3>
                        <p>Prévention et lutte contre le VIH/SIDA, promotion des droits sexuels et reproductifs pour les
                            populations cibles.</p>
                        <a class="ed-text-link" href="{{ url('/causes') }}">En savoir plus<span
                                aria-hidden="true">↗</span></a>
                    </article>
                    <article class="ed-service">
                        <span class="ed-step-number">03</span>
                        <h3>Autonomie socio-économique</h3>
                        <p>Renforcement de l'autonomie des populations vulnérables et des groupes marginalisés (déplacés
                            internes).</p>
                        <a class="ed-text-link" href="{{ url('/causes') }}">En savoir plus<span
                                aria-hidden="true">↗</span></a>
                    </article>
                </div>
            </div>
        </section>

        <section class="ed-section ed-pale">
            <div class="container">
                <header class="ed-heading">
                    <p class="ed-eyebrow">Notre approche méthodologique</p>
                    <h2>Des principes rigoureux pour un impact durable.</h2>
                </header>
                <ol class="ed-steps">
                    <li>
                        <span class="ed-step-number">01</span>
                        <h3>Approche centrée sur la survivante (ACS)</h3>
                        <p>Garantie de la confidentialité, de la sécurité et de la dignité des survivantes, tout en
                            facilitant l'accès aux services intégrés (Rutshuru, Goma, Drodro...).</p>
                    </li>
                    <li>
                        <span class="ed-step-number">02</span>
                        <h3>Ancrage communautaire et redevabilité</h3>
                        <p>Travail direct avec les communautés pour l'appropriation locale, le renforcement des capacités et
                            la confiance mutuelle.</p>
                    </li>
                    <li>
                        <span class="ed-step-number">03</span>
                        <h3>Accès et réseaux locaux</h3>
                        <p>Implantation territoriale permettant d'intervenir dans des zones difficiles en collaboration avec
                            les autorités et acteurs locaux.</p>
                    </li>
                    <li>
                        <span class="ed-step-number">04</span>
                        <h3>Durabilité et efficience</h3>
                        <p>Modèle d'exécution directe optimisant les ressources locales pour assurer autonomie, continuité
                            et usage efficient des fonds.</p>
                    </li>
                </ol>
            </div>
        </section>

        <section class="ed-section">
            <div class="container">
                <header class="ed-heading">
                    <p class="ed-eyebrow">Nos chiffres clés</p>
                    <h2>Notre impact en un coup d'œil.</h2>
                </header>
                <div class="ed-grid">
                    <article class="ed-service">
                        <span class="ed-step-number">+20</span>
                        <h3>Années d'expérience</h3>
                        <p>Créée en 2003, l'organisation conduit des actions continues sur le terrain.</p>
                    </article>
                    <article class="ed-service">
                        <span class="ed-step-number">50+</span>
                        <h3>Projets réalisés</h3>
                        <p>Menés à travers plusieurs pays, mobilisant un investissement global d'environ 1 million USD.</p>
                    </article>
                    <article class="ed-service">
                        <span class="ed-step-number">500+</span>
                        <h3>Collaborateurs</h3>
                        <p>Un effectif engagé auprès des groupes marginalisés et des personnes déplacées internes.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="ed-section">
            <div class="container">
                <header class="ed-heading">
                    <p class="ed-eyebrow">Questions fréquentes</p>
                    <h2>Informations utiles sur notre action.</h2>
                </header>
                <div class="ed-faq">
                    <details>
                        <summary>Où intervenons-nous principalement ?</summary>
                        <p>SOLIDARITÉS PLUS est active en République Démocratique du Congo (Bukavu, Rutshuru, Goma, Drodro
                            en Ituri), a opéré au Burundi et en Tanzanie, avec des perspectives d'extension.</p>
                    </details>
                    <details>
                        <summary>Quels sont nos publics cibles ?</summary>
                        <p>Nous ciblons en particulier les survivantes de violences basées sur le genre (VBG), les femmes,
                            les filles et les personnes déplacées internes les plus vulnérables.</p>
                    </details>
                    <details>
                        <summary>Comment collaborer avec SOLIDARITÉS PLUS ?</summary>
                        <p>Vous pouvez nous contacter directement via notre page de contact pour explorer des opportunités
                            de partenariat ou de soutien à nos programmes.</p>
                    </details>
                </div>
            </div>
        </section>

        <!-- Inclusion du composant CTA unifié -->
        @include('partials.cta', [
            'eyebrow' => 'Unissons nos forces',
            'title' => 'Ensemble, luttons contre les vulnérabilités.',
            'description' =>
                'Soutenez nos programmes ou engagez-vous à nos côtés pour faire une différence durable.',
            'buttonText' => 'Commencer un partenariat',
            'buttonUrl' => url('/contact'),
        ])

    </div>

@endsection
