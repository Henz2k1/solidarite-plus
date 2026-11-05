<!-- icons:start -->
<svg xmlns="http://www.w3.org/2000/svg" style="display:none" aria-hidden="true">
  <symbol id="i-menu" viewBox="0 0 24 24">
    <path d="M4 5h16"></path>
    <path d="M4 12h16"></path>
    <path d="M4 19h16"></path>
  </symbol>
</svg>
<!-- icons:end -->

<a class="skip-link visually-hidden-focusable" href="#main">Aller au contenu principal</a>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">SOLIDARITÉS PLUS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ftco-nav"
      aria-controls="ftco-nav" aria-expanded="false" aria-label="Basculer la navigation">
      <span class="ico"><svg class="lucide" aria-hidden="true">
          <use href="#i-menu"></use>
        </svg></span> Menu
    </button>

    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
          <a href="{{ url('/') }}" class="nav-link" {{ Request::is('/') ? 'aria-current=page' : '' }}>Accueil</a>
        </li>
        <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
          <a href="{{ url('/about') }}" class="nav-link">À propos</a>
        </li>
        <li class="nav-item {{ Request::is('impact') ? 'active' : '' }}">
          <a href="{{ url('/impact') }}" class="nav-link">Notre approche</a>
        </li>
        <li class="nav-item {{ Request::is('volunteer') ? 'active' : '' }}">
          <a href="{{ url('/volunteer') }}" class="nav-link">Blog</a>
        </li>
        <li class="nav-item {{ Request::is('event') ? 'active' : '' }}">
          <a href="{{ url('/event') }}" class="nav-link">Événements</a>
        </li>
        <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
          <a href="{{ url('/contact') }}" class="nav-link">Contacts</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- END nav -->
