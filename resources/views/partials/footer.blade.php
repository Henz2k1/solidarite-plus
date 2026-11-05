<footer class="ed-footer">
    <div class="container">
        <div class="ed-footer-grid">
            <div>
                <a class="ed-wordmark" href="{{ url('/') }}">SOLIDARITÉS PLUS<span>.</span></a>
                <p>Organisation engagée dans la protection, l'accompagnement des survivantes de VBG, la prévention du
                    VIH/SIDA et l'autonomisation en RDC.</p>
            </div>
            <div>
                <h2>Explorer</h2>
                <ul>
                    <li><a href="{{ url('/causes') }}">Nos causes</a></li>
                    <li><a href="{{ url('/impact') }}">Notre approche</a></li>
                    <li><a href="{{ url('/volunteer') }}">Rejoindre l'équipe</a></li>
                    <li><a href="{{ url('/event') }}">Événements</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
            </div>
            <div>
                <h2>Contactez-nous</h2>
                <p>Basé à Bukavu, RDC. Toutes vos questions sont les bienvenues.</p>
                <a class="ed-text-link" href="{{ url('/contact') }}">Nous contacter<span aria-hidden="true">↗</span></a>
                <p class="ed-note">SOLIDARITÉS PLUS RDC - Organisation à but non lucratif.</p>
            </div>
        </div>
        <div class="ed-footer-bottom">
            <p>© <span data-year="">2026</span> SOLIDARITÉS PLUS RDC. Tous droits réservés.</p>
            <a href="#">Retour en haut ↑</a>
        </div>
    </div>
</footer>

<!-- Scripts JS -->
<script src="{{ asset('vendor/bootstrap/5.3.8/js/bootstrap.bundle.min.js?v=3.1.0') }}"></script>
<script src="{{ asset('vendor/swiper/14.3.0/swiper-bundle.min.js?v=3.1.0') }}"></script>
<script src="{{ asset('vendor/photoswipe/5.4.4/umd/photoswipe.umd.min.js?v=3.1.0') }}"></script>
<script src="{{ asset('vendor/photoswipe/5.4.4/umd/photoswipe-lightbox.umd.min.js?v=3.1.0') }}"></script>
<script src="{{ asset('vendor/jarallax/3.1.0/jarallax.min.js?v=3.1.0') }}"></script>
<script src="{{ asset('js/main.min.js?v=3.1.0') }}"></script>
<script src="{{ asset('js/editorial.min.js?v=3.1.0') }}"></script>

@stack('scripts')
