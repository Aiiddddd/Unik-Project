@once
<style>
.site-footer{background:#071a2d;color:#d0dbe4}
.site-footer__main{padding:76px 0 88px}
.site-footer__grid{display:grid;grid-template-columns:1.55fr 1fr 1fr .7fr;gap:52px}
.site-footer__brand{max-width:340px}
.site-footer__logo{display:block;width:156px;height:auto;margin-bottom:22px}
.site-footer__description{margin:0 0 22px;color:#d0dbe4;font-size:15px;line-height:1.65}
.site-footer__contacts,.site-footer__links{display:grid;gap:12px;margin:0;padding:0;list-style:none}
.site-footer__contact{display:flex;align-items:flex-start;gap:10px;color:#d0dbe4;font-size:14px;line-height:1.5}
.site-footer__contact svg{width:18px;height:18px;flex:none;margin-top:1px;color:#24c4c5}
.site-footer__heading{margin:0 0 18px;color:#fff;font:700 20px/1.2 Figtree,system-ui,sans-serif}
.site-footer__links a{color:#d0dbe4;font-size:15px;text-decoration:none;transition:color .15s ease}
.site-footer__links a:hover,.site-footer__contact a:hover{color:#24c4c5}
.site-footer__contact a{color:inherit;text-decoration:none}
.site-footer__socials{display:flex;align-items:center;gap:16px}
.site-footer__social{display:grid;width:28px;height:28px;place-items:center;color:#24c4c5;text-decoration:none;transition:color .15s ease,transform .15s ease}
.site-footer__social:hover{color:#fff;transform:translateY(-2px)}
.site-footer__social svg{width:21px;height:21px;fill:currentColor}
.site-footer__social .instagram-icon{fill:none;stroke:currentColor;stroke-width:2}
.site-footer__bottom{background:#0b0e18;padding:17px 0;text-align:center;color:#fff;font-size:14px}
.site-footer__bottom a{color:#fff;font-weight:600;text-decoration:none}
.site-footer__bottom a:hover{text-decoration:underline}
@media(max-width:860px){
 .site-footer__main{padding:56px 0}
 .site-footer__grid{grid-template-columns:repeat(2,minmax(0,1fr));gap:38px 30px}
}
@media(max-width:520px){
 .site-footer__main{padding:44px 0}
 .site-footer__grid{grid-template-columns:1fr;gap:34px}
 .site-footer__brand{max-width:none}
 .site-footer__bottom{padding-right:72px;padding-left:22px;text-align:left}
}
@media(prefers-reduced-motion:reduce){
 .site-footer__links a,.site-footer__social{transition:none}
}
</style>
@endonce

<footer class="site-footer">
 <div class="site-footer__main">
  <div class="wrap site-footer__grid">
   <div class="site-footer__brand">
    <a href="{{ route('home') }}" aria-label="{{ $c['name'] }}">
     <img class="site-footer__logo" src="{{ asset('images/logo-unik.png') }}" alt="{{ $c['name'] }}" width="459" height="118">
    </a>
    <p class="site-footer__description">A Jakarta-based event management company creating meaningful experiences through creative planning and seamless execution.</p>
    <ul class="site-footer__contacts">
     <li class="site-footer__contact">
      <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.6 10.8a15.5 15.5 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1.03-.24c1.13.37 2.34.56 3.57.56.55 0 1 .45 1 1V20c0 .55-.45 1-1 1C10.6 21 3 13.4 3 4c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.23.19 2.44.56 3.57a1 1 0 0 1-.24 1.03z"/></svg>
      <a href="tel:{{ preg_replace('/\D+/', '', $c['contact']['phone']) }}">{{ $c['contact']['phone'] }}</a>
     </li>
     <li class="site-footer__contact">
      <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 2a10 10 0 0 0-8.67 14.98L2 22l5.2-1.3A10 10 0 1 0 12 2m0 18a8 8 0 0 1-4.08-1.12l-.3-.18-3.08.77.82-3-.2-.32A8 8 0 1 1 12 20m4.4-5.98c-.24-.12-1.42-.7-1.64-.78-.22-.08-.38-.12-.54.12-.16.24-.62.78-.76.94-.14.16-.28.18-.52.06a6.57 6.57 0 0 1-1.93-1.19 7.24 7.24 0 0 1-1.34-1.67c-.14-.24-.02-.37.1-.49.1-.1.24-.28.36-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.54-1.3-.74-1.78-.2-.46-.4-.4-.54-.4h-.46c-.16 0-.42.06-.64.3-.22.24-.84.82-.84 2s.86 2.32.98 2.48c.12.16 1.7 2.6 4.12 3.64.58.25 1.03.4 1.38.51.58.18 1.1.15 1.52.09.46-.07 1.42-.58 1.62-1.14.2-.56.2-1.04.14-1.14-.06-.1-.22-.16-.46-.28"/></svg>
      <a href="https://wa.me/{{ $c['contact']['whatsapp'] }}" target="_blank" rel="noopener noreferrer">WhatsApp {{ $c['contact']['mobile'] }}</a>
     </li>
     <li class="site-footer__contact">
      <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m0 4-8 5-8-5V6l8 5 8-5z"/></svg>
      <a href="mailto:{{ $c['contact']['email'] }}">{{ $c['contact']['email'] }}</a>
     </li>
    </ul>
   </div>

   <div>
    <h2 class="site-footer__heading">Company</h2>
    <ul class="site-footer__links">
     <li><a href="{{ route('home') }}#about">About UNIK</a></li>
     <li><a href="{{ route('home') }}#services">What We Do</a></li>
     <li><a href="{{ route('home') }}#why">Why Choose Us</a></li>
     <li><a href="{{ route('home') }}#clients">Our Clients</a></li>
     <li><a href="{{ route('home') }}#team">Our Team</a></li>
     <li><a href="{{ route('home') }}#contact">Contact Us</a></li>
    </ul>
   </div>

   <div>
    <h2 class="site-footer__heading">Services</h2>
    <ul class="site-footer__links">
     @foreach(config('whatwedo.services', []) as $service)
      <li><a href="{{ route('home') }}#services">{{ $service['tab'] }}</a></li>
     @endforeach
    </ul>
   </div>

   <div>
    <h2 class="site-footer__heading">Follow Us</h2>
    <div class="site-footer__socials">
     <a class="site-footer__social" href="https://www.instagram.com/{{ $c['contact']['instagram'] }}/" target="_blank" rel="noopener noreferrer" aria-label="Follow UNIK on Instagram">
      <svg class="instagram-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".8" fill="currentColor" stroke="none"/></svg>
     </a>
     <a class="site-footer__social" href="mailto:{{ $c['contact']['email'] }}" aria-label="Email UNIK">
      <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m0 4-8 5-8-5V6l8 5 8-5z"/></svg>
     </a>
    </div>
   </div>
  </div>
 </div>
 <div class="site-footer__bottom">
  © {{ date('Y') }} {{ $c['legal'] }}. All rights reserved.
  <!-- <span aria-hidden="true"> · </span> -->
  <!-- Website by <a href="{{ $c['developer']['url'] }}" target="_blank" rel="noopener noreferrer">{{ $c['developer']['name'] }}</a> -->
 </div>
</footer>
