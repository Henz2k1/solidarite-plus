@extends('layouts.app')

@section('title', 'Notre approche & redevabilité — SOLIDARITÉS PLUS RDC')

@section('content')

    <!-- Inclusion de la bannière spécifique à la page "Notre approche" -->
    @include('partials.banner', [
        'bgClass' => 'bg-photo-1',
        'title' => 'Notre approche &amp; redevabilité',
        'subtitle' => 'Un cadre clair et transparent pour planifier, exécuter et évaluer nos actions humanitaires en RDC.',
        'buttonText' => null,
        'buttonUrl' => null
    ])

    <div class="ed">

        <section class="ed-section ed-pale">
            <div class="container">
                <header class="ed-heading">
                    <p class="ed-eyebrow">Comment nous travaillons</p>
                    <h2>Un parcours clair, de l'idée à l'action.</h2>
                </header>
                <ol class="ed-steps">
                    <li>
                        <span class="ed-step-number">01</span>
                        <h3>Écouter</h3>
                        <p>Consulter les acteurs locaux et les communautés pour identifier ce qui fonctionne déjà et cibler les besoins prioritaires.</p>
                    </li>
                    <li>
                        <span class="ed-step-number">02</span>
                        <h3>Planifier</h3>
                        <p>Définir un périmètre réaliste, les responsabilités opérationnelles et un budget prévisionnel transparent.</p>
                    </li>
                    <li>
                        <span class="ed-step-number">03</span>
                        <h3>Travailler ensemble</h3>
                        <p>Soutenir la mise en œuvre sur le terrain, partager les progrès et intégrer en continu les retours des bénéficiaires.</p>
                    </li>
                    <li>
                        <span class="ed-step-number">04</span>
                        <h3>Rester redevable</h3>
                        <p>Évaluer la gestion des ressources, assurer le suivi rigoureux des actions et publier les axes d'amélioration.</p>
                    </li>
                </ol>
            </div>
        </section>

        <section class="ed-section">
            <div class="container">
                <header class="ed-heading">
                    <p class="ed-eyebrow">Transparence & Suivi</p>
                    <h2>Des plans clairs. Un rapportage honnête.</h2>
                </header>
                <div class="ed-reading">
                    <p class="ed-lead">Les données et chiffres n'ont de valeur que si l'histoire et l'impact humain derrière eux sont parfaitement compréhensibles.</p>

                    <h2>Ce que comprend un suivi d'intervention</h2>
                    <p>Une explication synthétique du travail accompli sur le terrain, l’état d'avancement des dépenses par rapport au plan initial, les évolutions constatées et les défis restants. Les retours communautaires sont systématiquement intégrés aux côtés des indicateurs financiers.</p>

                    <h2>Respect et dignité des personnes</h2>
                    <p>Aucune personne assistée n'est tenue de fournir une photographie ou un témoignage public en échange d'un soutien. Nous partageons les apprentissages globaux sans jamais exposer les situations individuelles ni compromettre la sécurité des bénéficiaires.</p>

                    <h2>Exemples de structures budgétaires</h2>
                    <table>
                        <caption>Projections et cibles budgétaires indicatives de nos programmes</caption>
                        <thead>
                            <tr>
                                <th scope="col">Programme d'intervention</th>
                                <th scope="col">Cible budgétaire estimée</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Accès à l'eau potable & hygiène d'urgence</th>
                                <td>12 000 $</td>
                            </tr>
                            <tr>
                                <th scope="row">Espaces d'apprentissage et de protection sécurisés</th>
                                <td>8 000 $</td>
                            </tr>
                            <tr>
                                <th scope="row">Appui à l'autonomisation et à la résilience communautaire</th>
                                <td>6 000 $</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="ed-note">Ces chiffres sont présentés à titre d'illustration de la méthodologie de cadrage budgétaire de SOLIPLUS.</p>
                </div>
            </div>
        </section>

        <!-- Inclusion du composant CTA pour la page Notre Approche -->
       @include('partials.cta', [
            'eyebrow' => 'Unissons nos forces',
            'title' => 'Ensemble, luttons contre les vulnérabilités.',
            'description' =>
                'Soutenez nos programmes ou engagez-vous à nos côtés pour faire une différence durable.',
            'buttonText' => 'Commencer un partenariat',
            'buttonUrl' => url('/contact'),
        ])

    </div> <!-- Fermeture du <div class="ed"> -->

@endsection
