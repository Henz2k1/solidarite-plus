@extends('layouts.app')

@section('title', 'Contactez-nous — SOLIDARITÉS PLUS RDC')

@section('content')

    <!-- Inclusion de la bannière spécifique à la page "Contact" -->
    @include('partials.banner', [
        'bgClass' => 'bg-photo-2',
        'title' => 'Commencer une conversation',
        'subtitle' => 'Posez une question, explorez une idée ou découvrez comment collaborer avec nous.',
        'buttonText' => null,
        'buttonUrl' => null
    ])

    <div class="ed">

        <section class="ed-section">
            <div class="container">
                <header class="ed-heading">
                    <p class="ed-eyebrow">Entrer en contact</p>
                    <h2>Dites-nous en un peu plus sur votre démarche.</h2>
                </header>
                <div class="ed-split">
                    <div>
                        <p class="ed-lead">Un point de départ clair est tout ce dont vous avez besoin.</p>
                        <p>Partagez le contexte, vos disponibilités et la meilleure façon de vous répondre. Veuillez ne pas inclure d'informations sensibles ou confidentielles.</p>
                        <dl class="ed-contact-info">
                            <dt>Que se passe-t-il ensuite ?</dt>
                            <dd>L'équipe examine votre message et vous répond avec une proposition concrète.</dd>
                            <dt>Avant d'envoyer</dt>
                            <dd>Pour toute urgence humanitaire ou de terrain, privilégiez nos contacts directs à Bukavu.</dd>
                        </dl>
                    </div>
                    <div class="ed-form-panel">
                        <form action="{{ url('/send-email') }}" method="post" data-kit-form="" data-success="Merci ! Votre message a bien été envoyé ; nous vous répondrons dans les deux jours ouvrés.">
                            @csrf
                            <div class="form-group">
                                <label class="visually-hidden" for="c-name">Votre Nom</label>
                                <input type="text" class="form-control" name="name" id="c-name" placeholder="Votre Nom" autocomplete="name" required="">
                            </div>
                            <div class="form-group">
                                <label class="visually-hidden" for="c-email">Votre Email</label>
                                <input type="email" class="form-control" name="email" id="c-email" placeholder="Votre Email" autocomplete="email" required="">
                            </div>
                            <div class="form-group">
                                <label class="visually-hidden" for="c-subject">Sujet</label>
                                <input type="text" class="form-control" name="subject" id="c-subject" placeholder="Sujet" required="">
                            </div>
                            <div class="form-group">
                                <label class="visually-hidden" for="c-message">Message</label>
                                <textarea name="message" id="c-message" cols="30" rows="7" class="form-control" placeholder="Message" required=""></textarea>
                            </div>
                            <div class="form-group">
                                <div aria-hidden="true" style="position:absolute!important;left:-10000px!important;width:1px!important;height:1px!important;overflow:hidden!important">
                                    <label>Laissez ce champ vide <input type="text" name="cl_hp_url" value="" tabindex="-1" autocomplete="off"></label>
                                </div>
                                <input type="submit" value="Envoyer le message" class="btn btn-primary py-3 px-5">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="ed-section ed-pale">
            <div class="container">
                <header class="ed-heading">
                    <p class="ed-eyebrow">Où nous trouver</p>
                    <h2>Nos bureaux et zones d'intervention.</h2>
                </header>
                <p class="ed-note">Siège social : Bukavu, Province du Sud-Kivu, République Démocratique du Congo.</p>
                <div id="map" class="map kit-map" data-kit-map="" data-map-src="https://www.openstreetmap.org/export/embed.html?bbox=28.8500%2C-2.5200%2C28.8700%2C-2.5000&amp;layer=mapnik&amp;marker=-2.5100%2C28.8600" data-map-title="Carte montrant notre bureau à Bukavu, RDC">
                    <div class="kit-map__placeholder">
                        <p class="kit-map__address">Bukavu, Sud-Kivu, RDC (Interventions également à Rutshuru, Goma et Drodro)</p>
                        <div class="kit-map__actions">
                            <button type="button" class="btn btn-primary py-3 px-4" data-kit-map-show="">Afficher la carte</button>
                            <a href="https://www.openstreetmap.org/?mlat=-2.5100&mlon=28.8600#map=15/-2.5100/28.8600" target="_blank" rel="noopener">Ouvrir dans les cartes</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ed-section">
            <div class="container">
                <header class="ed-heading">
                    <p class="ed-eyebrow">Informations utiles</p>
                    <h2>Avant de nous écrire.</h2>
                </header>
                <div class="ed-faq">
                    <details>
                        <summary>Comment démarrer une collaboration ?</summary>
                        <p>Une brève conversation est un excellent premier point de départ. Dites-nous ce qui vous intéresse et nous vous orienterons vers la bonne démarche sans engagement.</p>
                    </details>
                    <details>
                        <summary>Puis-je poser des questions sur nos programmes VBG ?</summary>
                        <p>Oui. Nos équipes gèrent chaque demande avec la plus stricte confidentialité et dans le respect de l'éthique humanitaire.</p>
                    </details>
                    <details>
                        <summary>Comment soutenir les actions de SOLIDARITÉS PLUS ?</summary>
                        <p>Utilisez ce formulaire pour toute proposition de partenariat, de soutien technique ou financier à nos programmes en RDC.</p>
                    </details>
                </div>
            </div>
        </section>

        <!-- Inclusion du composant CTA -->
        @include('partials.cta', [
            'eyebrow' => 'Unissons nos forces',
            'title' => 'Ensemble, luttons contre les vulnérabilités.',
            'description' => 'Soutenez nos programmes ou engagez-vous à nos côtés pour faire une différence durable.',
            'buttonText' => 'Commencer un partenariat',
            'buttonUrl' => url('/contact'),
        ])

    </div> <!-- Fermeture du <div class="ed"> -->

@endsection
