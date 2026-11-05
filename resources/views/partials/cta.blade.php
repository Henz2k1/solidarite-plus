<section class="ed-section ed-cta" id="contact-section">
  <div class="container">
    <header class="ed-heading">
      <p class="ed-eyebrow">{{ $eyebrow ?? 'Rejoignez-nous' }}</p>
      <h2>{{ $title ?? 'Ensemble pour faire la différence.' }}</h2>
    </header>
    <div class="ed-cta-row">
      <p>{{ $description ?? 'Soutenez nos actions de protection, devenez partenaire ou échangez avec nos équipes sur le terrain.' }}</p>
      <a class="ed-button" href="{{ $buttonUrl ?? url('/contact') }}">{{ $buttonText ?? 'Engager la conversation' }}<span aria-hidden="true">↗</span></a>
    </div>
  </div>
</section>



{{-- Appel CTA --}}

{{-- @include('partials.cta', [
    'eyebrow' => 'Unissons nos forces',
    'title' => 'Ensemble, luttons contre les vulnérabilités.',
    'description' => 'Soutenez nos programmes ou engagez-vous à nos côtés pour faire une différence durable.',
    'buttonText' => 'Commencer un partenariat',
    'buttonUrl' => url('/contact')
]) --}}
