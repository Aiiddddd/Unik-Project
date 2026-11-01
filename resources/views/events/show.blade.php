<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
@include('partials.seo')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700;800&family=Figtree:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
<style>
:root {
  --ink: #1b1d1d;
  --ink-soft: #424a4d;
  --mute: #5a6467;
  --teal: #0d7d8d;
  --teal-d: #0b5d6d;
  --or: #1a8a98;
  --line: #e7ebec;
  --paper: #f7f7f4;
  --panel: #ffffff;
  --shadow: 0 18px 45px rgba(17, 40, 45, 0.12);
  --radius: 18px;
  color-scheme: light;
}

*, *:before, *:after { box-sizing: border-box; }
html { scroll-behavior: smooth; }
body {
  margin: 0;
  background: linear-gradient(180deg, #f9f9f6 0%, #f3f6f6 100%);
  color: var(--ink);
  font: 400 17px/1.7 Figtree, system-ui, sans-serif;
}
h1, h2, h3, h4 {
  margin: 0;
  line-height: 1.12;
  color: var(--ink);
  font-family: 'Playfair Display', Georgia, serif;
}
a { color: inherit; }
img { display: block; max-width: 100%; }
:focus-visible { outline: 3px solid var(--teal); outline-offset: 3px; }

.wrap {
  max-width: 1160px;
  margin: 0 auto;
  padding: 0 22px;
}
header {
  position: sticky;
  top: env(safe-area-inset-top, 0px);
  z-index: 9;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(8px);
  border-bottom: 1px solid var(--line);
}
.bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 72px;
}
.logo { display: flex; align-items: center; text-decoration: none; }
.logo img { height: 36px; width: auto; }
nav {
  display: flex;
  gap: 26px;
  align-items: center;
  font-weight: 600;
  font-size: 15px;
}
nav a { text-decoration: none; }
nav a:not(.btn):hover { color: var(--teal-d); }
.bar nav .btn {
  background: #1a8a98;
  color: var(--ink);
  padding: 14px 26px;
  border: 2px solid #1a8a98;
  border-radius: 999px 999px 999px 6px;
  box-shadow: none;
}
.btn {
  display: inline-block;
  background: linear-gradient(135deg, var(--or), #1a8a98);
  color: #fff;
  border: 0;
  font: 700 15px Montserrat, system-ui, sans-serif;
  padding: 14px 24px;
  border-radius: 999px;
  text-decoration: none;
  cursor: pointer;
  transition: transform .18s ease, box-shadow .18s ease;
}
.btn:hover {
  transform: translateY(-2px);
}
.btn.ghost {
  background: transparent;
  color: var(--teal-d);
  border: 1.5px solid rgba(13, 125, 141, 0.28);
  box-shadow: none;
}
.btn.ghost:hover {
  background: var(--teal-d);
  color: #fff;
  border-color: var(--teal-d);
}
.menu {
  display: none;
  background: none;
  border: 0;
  font-size: 28px;
  color: var(--ink);
  cursor: pointer;
}

.ev-hero {
  position: relative;
  display: flex;
  align-items: flex-end;
  min-height: min(72vh, 620px);
  padding: 92px 0 58px;
  color: #fff;
  background:
    linear-gradient(180deg, rgba(10, 15, 17, 0.18) 0%, rgba(10, 15, 17, 0.62) 100%),
    linear-gradient(90deg, rgba(12, 18, 19, 0.78) 0%, rgba(12, 18, 19, 0.2) 52%, rgba(12, 18, 19, 0.7) 100%),
    var(--img) center/cover no-repeat #1d2122;
}
.ev-hero .wrap { width: 100%; }
.crumb {
  display: flex;
  flex-wrap: wrap;
  gap: 9px;
  margin-bottom: 18px;
  font-size: 14px;
  color: rgba(255, 255, 255, 0.9);
}
.crumb a { text-decoration: none; }
.crumb a:hover { text-decoration: underline; }
.ev-cat {
  display: inline-flex;
  align-items: center;
  padding: 7px 12px;
  border-radius: 999px;
  margin-bottom: 16px;
  background: rgba(255, 255, 255, 0.12);
  border: 1px solid rgba(255, 255, 255, 0.14);
  font: 600 11px Figtree, system-ui, sans-serif;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: #dff7fb;
}
.ev-hero h1 {
  color: #fff;
  font-size: clamp(34px, 5vw, 62px);
  max-width: 18em;
  text-wrap: balance;
  text-shadow: 0 8px 20px rgba(0, 0, 0, 0.22);
}
.ev-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 12px 28px;
  margin: 24px 0 0;
}
.ev-meta div {
  min-width: 120px;
}
.ev-meta dt {
  color: rgba(255, 255, 255, 0.72);
  font: 600 11px Figtree, system-ui, sans-serif;
  letter-spacing: 0.14em;
  text-transform: uppercase;
}
.ev-meta dd {
  margin: 3px 0 0;
  color: #fff;
  font-size: 16px;
  font-weight: 600;
}

.ev-body {
  padding: 58px 0 36px;
}
.prose {
  max-width: 900px;
  margin: 0 auto;
  padding: 32px 32px 8px;
  background: rgba(255, 255, 255, 0.7);
  border: 1px solid rgba(35, 48, 52, 0.06);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  font-size: 18px;
}
.prose > *:first-child { margin-top: 0; }
.prose h2 { font-size: 30px; margin: 1.7em 0 .55em; }
.prose h3 { font-size: 24px; margin: 1.4em 0 .45em; }
.prose p { margin: 0 0 1.1em; }
.prose ul, .prose ol { margin: 0 0 1.1em; padding-left: 1.3em; }
.prose li { margin: .3em 0; }
.prose img { border-radius: 12px; margin: 1.4em 0; box-shadow: 0 8px 24px rgba(16, 27, 30, 0.12); }
.prose a { color: var(--teal-d); text-decoration: underline; }
.prose blockquote {
  margin: 1.4em 0;
  padding: 12px 0 12px 18px;
  border-left: 4px solid var(--or);
  color: var(--mute);
  background: rgba(234, 106, 43, 0.04);
  border-radius: 0 12px 12px 0;
}

.sec { padding: 28px 0 68px; }
.sec h2 { font-size: clamp(28px, 3vw, 36px); margin-bottom: 24px; }
.gallery-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  margin-bottom: 14px;
}
.gallery-head h2 { margin-bottom: 0; }
.gal-pager { display: flex; align-items: center; gap: 12px; flex: none; }
.gal-pager[hidden] { display: none; }
.gal-pager button {
  display: grid;
  place-items: center;
  width: 42px;
  height: 42px;
  border: 1px solid var(--line);
  border-radius: 50%;
  background: #fff;
  color: var(--ink);
  cursor: pointer;
  transition: border-color .2s, color .2s;
}
.gal-pager button:hover:not(:disabled) { border-color: var(--teal); color: var(--teal-d); }
.gal-pager button:disabled { opacity: .35; cursor: default; }
.gal-pager svg {
  width: 18px;
  height: 18px;
  fill: none;
  stroke: currentColor;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
}
.gal-count { min-width: 64px; color: var(--mute); font-size: 14px; font-weight: 600; text-align: center; }
.gal {
  display: flex;
  overflow-x: auto;
  gap: 16px;
  padding: 10px 4px 26px;
  margin: -10px -4px 0;
  scroll-snap-type: x mandatory;
  scroll-behavior: smooth;
  scrollbar-width: none;
  -webkit-overflow-scrolling: touch;
}
.gal::-webkit-scrollbar { display: none; }
.gallery-slide {
  display: grid;
  flex: 0 0 100%;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  min-width: 0;
  gap: 16px;
  scroll-snap-align: start;
}
.gl {
  width: 100%;
  border: 0;
  border-radius: 16px;
  overflow: hidden;
  background: #222;
  padding: 0;
  cursor: zoom-in;
  aspect-ratio: 4 / 3;
  box-shadow: 0 16px 28px rgba(18, 38, 42, 0.1);
}
.gl img { width: 100%; height: 100%; object-fit: cover; transition: transform .45s ease; }
.gl:hover img { transform: scale(1.04); }

.rel {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 22px;
}
.rc {
  display: flex;
  flex-direction: column;
  border: 1px solid rgba(19, 33, 39, 0.08);
  border-radius: 16px;
  overflow: hidden;
  background: #fff;
  box-shadow: 0 14px 28px rgba(20, 27, 29, 0.08);
  text-decoration: none;
  color: inherit;
  transition: transform .2s ease, box-shadow .2s ease;
}
.rc:hover {
  transform: translateY(-4px);
  box-shadow: 0 22px 32px rgba(20, 27, 29, 0.12);
}
.rc .im { aspect-ratio: 16 / 9.5; background: #222; overflow: hidden; }
.rc .im img { width: 100%; height: 100%; object-fit: cover; }
.rc .tx { padding: 16px 18px 20px; }
.rc .cat {
  font: 600 10.5px Figtree, system-ui, sans-serif;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--teal-d);
}
.rc h3 { font-size: 19px; margin: 8px 0 7px; }
.rc p { margin: 0; color: var(--mute); font-size: 14px; line-height: 1.55; }

.cta {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 28px;
  flex-wrap: wrap;
  margin: 8px 0 44px;
  padding: 38px 32px;
  border-radius: 20px;
  background: linear-gradient(135deg, #eaf5f6 0%, #d8edf1 100%);
  border: 1px solid rgba(12, 93, 109, 0.08);
  box-shadow: 0 14px 34px rgba(19, 42, 55, 0.08);
}
.cta h2 { font-size: clamp(24px, 3vw, 34px); color: var(--teal-d); }
.cta p { margin: 8px 0 0; color: var(--mute); }
.back {
  display: inline-block;
  margin: 0 0 62px;
  font-weight: 600;
  color: var(--teal-d);
  text-decoration: none;
}
.back:hover { text-decoration: underline; }

footer {
  border-top: 4px solid var(--teal);
  padding: 28px 0 32px;
  font-size: 14px;
  color: var(--mute);
}
footer .wrap {
  display: flex;
  justify-content: space-between;
  gap: 12px;
  flex-wrap: wrap;
}

.wa {
  position: fixed;
  right: max(18px, env(safe-area-inset-right, 0px));
  bottom: max(18px, env(safe-area-inset-bottom, 0px));
  z-index: 50;
  width: 58px;
  height: 58px;
  display: grid;
  place-items: center;
  background: #25d366;
  color: #fff;
  border-radius: 50%;
  text-decoration: none;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
  transition: transform .15s ease, box-shadow .15s ease;
}
.wa:hover { transform: translateY(-2px); box-shadow: 0 10px 22px rgba(0, 0, 0, 0.28); }
.wa svg { width: 26px; height: 26px; display: block; fill: currentColor; }

.lb { position: fixed; border: 0; padding: 0; width: min(1000px, 94vw); max-height: 92vh; border-radius: 12px; background: #111; color: #fff; overflow: hidden; }
.lb::backdrop { background: rgba(10, 12, 13, 0.82); }
.lb img { width: 100%; max-height: 80vh; object-fit: contain; background: #111; }
.lb-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 12px 18px;
  font: 600 14px Figtree, system-ui, sans-serif;
}
.lb-bar div { display: flex; gap: 10px; }
.lb button {
  width: 40px; height: 40px; border-radius: 50%; border: 1px solid rgba(255,255,255,.35); background: transparent; color: #fff; font-size: 20px; cursor: pointer;
}
.lb button:hover { background: rgba(255, 255, 255, .15); }

@media (max-width: 860px) {
  .ev-body { padding-top: 42px; }
  .prose { padding: 24px 20px 6px; }
  .gallery-slide { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .rel { grid-template-columns: 1fr 1fr; }
  .menu { display: block; }
  .logo img { height: 32px; }
  nav {
    position: absolute;
    top: 72px;
    left: 0;
    right: 0;
    display: none;
    flex-direction: column;
    align-items: flex-start;
    padding: 18px 22px;
    background: #fff;
    border-bottom: 1px solid var(--line);
  }
  nav.open { display: flex; }
}
@media (max-width: 560px) {
  .rel { grid-template-columns: 1fr; }
  .cta { padding: 28px 22px; }
}
@media (prefers-reduced-motion: reduce) {
  html { scroll-behavior: auto; }
  .btn, .rc, .gl img { transition: none; }
  .gal { scroll-behavior: auto; }
}
</style>
</head>
<body>

<header><div class="wrap bar">
     <a class="logo" href="{{ $homeUrl }}" aria-label="{{ $c['name'] }}"><img src="{{ asset('images/logo-unik-navbar@2x.png') }}" alt="{{ $c['name'] }}" width="459" height="118"></a>
 <button class="menu" aria-label="Menu" aria-expanded="false" id="mb">☰</button>
 <nav id="nav">
  <a href="{{ $homeUrl }}#about">About</a>
  <a href="{{ $homeUrl }}#services">Services</a>
  <a href="{{ $homeUrl }}#why">Why us</a>
  <a href="{{ $homeUrl }}#clients">Clients</a>
  <a href="{{ $homeUrl }}#team">Team</a>
  <a class="btn" href="https://wa.me/{{ $c['contact']['whatsapp'] }}?text={{ rawurlencode('Hello UNIK Event Solutions, I would like to plan an event.') }}" target="_blank" rel="noopener">Contact us</a>
 </nav>
</div></header>

<main>
 <section class="ev-hero" style="--img:url('{{ $project->cover_url }}')">
  <div class="wrap">
   <div class="crumb">
    <a href="{{ $homeUrl }}#services">{{ __('site.what_we_do') }}</a><span>/</span>
    <a href="{{ $homeUrl }}#services">{{ $service['tab'] ?? 'Events' }}</a>
   </div>
   @if($project->tr('category'))<span class="ev-cat">{{ $project->tr('category') }}</span>@endif
   <h1>{{ $project->tr('title') }}</h1>
   @if(filled($project->client) || filled($project->period) || filled($project->location))
    <dl class="ev-meta">
     @if(filled($project->client))<div><dt>{{ __('site.event.client') }}</dt><dd>{{ $project->client }}</dd></div>@endif
     @if(filled($project->period))<div><dt>{{ __('site.event.period') }}</dt><dd>{{ $project->period }}</dd></div>@endif
     @if(filled($project->location))<div><dt>{{ __('site.event.location') }}</dt><dd>{{ $project->location }}</dd></div>@endif
    </dl>
   @endif
  </div>
 </section>

 <div class="wrap">
  @php
   $eventContent = $project->tr('content');
   $hasEventContent = filled(strip_tags($eventContent ?? ''));
  @endphp
  @if($hasEventContent)
   <div class="ev-body">
    <article class="prose">
     {!! str($eventContent)->sanitizeHtml() !!}
    </article>
   </div>
  @endif

  @if(count($project->gallery_urls))
   <section class="sec">
    <div class="gallery-head">
     <h2>{{ __('site.event.gallery') }}</h2>
     <div class="gal-pager" hidden>
      <button type="button" class="gal-prev" aria-label="{{ __('site.prev_projects') }}"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg></button>
      <span class="gal-count" aria-live="polite"></span>
      <button type="button" class="gal-next" aria-label="{{ __('site.next_projects') }}"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg></button>
     </div>
    </div>
    <div class="gal" tabindex="0" role="region" aria-label="{{ __('site.event.gallery') }}">
     @foreach(collect($project->gallery_urls)->chunk(6) as $pageIndex => $page)
      <div class="gallery-slide">
       @foreach($page as $photoIndex => $url)
        @php $photoNumber = ($pageIndex * 6) + $photoIndex + 1; @endphp
        <button type="button" class="gl" data-full="{{ $url }}" aria-label="{{ __('site.event.open_photo', ['n' => $photoNumber]) }}"><img src="{{ $url }}" alt="{{ __('site.event.photo_alt', ['title' => $project->tr('title'), 'n' => $photoNumber]) }}" loading="lazy"></button>
       @endforeach
      </div>
     @endforeach
    </div>
   </section>
  @endif

  @if($related->count())
   <section class="sec">
    <h2>{{ __('site.event.more_in', ['tab' => $service['tab'] ?? __('site.event.this_category')]) }}</h2>
    <div class="rel">
     @foreach($related as $r)
      <a class="rc" href="{{ route(app()->getLocale() === 'id' ? 'events.show.id' : 'events.show', $r) }}">
       <div class="im"><img src="{{ $r->cover_url }}" alt="{{ $r->tr('title') }}" loading="lazy"></div>
       <div class="tx">
        @if($r->tr('category'))<span class="cat">{{ $r->tr('category') }}</span>@endif
        <h3>{{ $r->tr('title') }}</h3>
        <p>{{ $r->tr('summary') }}</p>
       </div>
      </a>
     @endforeach
    </div>
   </section>
  @endif

  <div class="cta">
   <div>
    <h2>{{ __('site.event.cta_title') }}</h2>
    <p>{{ __('site.event.cta_text') }}</p>
   </div>
   <a class="btn ghost" href="{{ $homeUrl }}#contact">{{ __('site.event.cta_button') }}</a>
  </div>

  <a class="back" href="{{ $homeUrl }}#services">&larr; {{ __('site.event.back') }}</a>
 </div>
</main>

<footer><div class="wrap"><span>© {{ date('Y') }} {{ $c['legal'] }}</span><span>{{ $c['contact']['website'] ?? '' }}</span></div></footer>

<a class="wa" href="https://wa.me/{{ $c['contact']['whatsapp'] ?? '' }}?text={{ rawurlencode(__('site.wa_text')) }}" target="_blank" rel="noopener" aria-label="{{ __('site.chat_wa') }}">
 <svg viewBox="0 0 32 32" aria-hidden="true" focusable="false"><path d="M16 3.1C8.8 3.1 3 8.8 3 16c0 2.5.7 4.9 2 6.9L3 29l6.2-2.1c2 1.1 4.3 1.7 6.8 1.7 7.2 0 13.1-5.7 13.1-13.1S23.2 3.1 16 3.1zm0 22.6c-2.1 0-4.2-.6-6-1.7l-.4-.2-3.7 1.2 1.2-3.6-.2-.4A10.5 10.5 0 0 1 5.5 16c0-5.8 4.7-10.5 10.5-10.5s10.5 4.7 10.5 10.5-4.7 10.5-10.5 10.5zm5.8-7.8c-.3-.2-1.8-.9-2-.9-.2-.1-.4-.1-.6.1-.2.2-.7.9-.9 1.1-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.6-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.7.1-.1.2-.3.4-.4.1-.1.2-.3.3-.5.1-.2.1-.3 0-.5-.1-.2-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.8.3-.3.3-1 1-1 2.4s1 2.8 1.2 3c.2.2 2.1 3.2 5.1 4.4.7.3 1.3.5 1.8.6.7.2 1.3.2 1.8.1.6-.1 1.8-.7 2-.9.2-.2.3-.4.4-.6.1-.2.1-.5 0-.7-.1-.2-.3-.2-.7-.4z"/></svg>
</a>

<dialog class="lb" id="lb" aria-label="{{ __('site.event.viewer') }}">
 <img id="lbImg" src="" alt="">
 <div class="lb-bar">
  <span id="lbCount"></span>
  <div>
   <button type="button" id="lbPrev" aria-label="{{ __('site.event.prev_photo') }}">&lsaquo;</button>
   <button type="button" id="lbNext" aria-label="{{ __('site.event.next_photo') }}">&rsaquo;</button>
   <button type="button" id="lbX" aria-label="{{ __('site.event.close') }}">&times;</button>
  </div>
 </div>
</dialog>

<script>
(function(){
 var mb=document.getElementById('mb'),nv=document.getElementById('nav');
 mb.addEventListener('click',function(){var o=nv.classList.toggle('open');mb.setAttribute('aria-expanded',o)});
 nv.addEventListener('click',function(){nv.classList.remove('open');mb.setAttribute('aria-expanded','false')});

 var gallery=document.querySelector('.gal'),galleryPager=document.querySelector('.gal-pager');
 var calm=window.matchMedia&&window.matchMedia('(prefers-reduced-motion: reduce)').matches;
 function galleryMetrics(){
  var first=gallery&&gallery.querySelector('.gallery-slide');if(!first)return null;
  var gap=parseFloat(getComputedStyle(gallery).columnGap)||16;
  var step=first.getBoundingClientRect().width+gap;
  return {step:step};
 }
 function updateGallery(){
  if(!gallery||!galleryPager)return;
  var metrics=galleryMetrics(),total=gallery.querySelectorAll('.gl').length;
  var pageCount=gallery.querySelectorAll('.gallery-slide').length;
  var overflow=!!metrics&&pageCount>1&&gallery.scrollWidth-gallery.clientWidth>4;
  galleryPager.hidden=!overflow;
  if(!overflow)return;
  var page=Math.min(pageCount-1,Math.max(0,Math.round(gallery.scrollLeft/metrics.step)));
  var first=(page*6)+1;
  var last=Math.min(total,page*6+6);
  document.querySelector('.gal-count').textContent=first+(last>first?'\u2013'+last:'')+' / '+total;
  document.querySelector('.gal-prev').disabled=gallery.scrollLeft<=2;
  document.querySelector('.gal-next').disabled=gallery.scrollLeft>=gallery.scrollWidth-gallery.clientWidth-2;
 }
 function moveGallery(direction){
  var metrics=galleryMetrics();if(!metrics)return;
  gallery.scrollBy({left:direction*metrics.step,behavior:calm?'auto':'smooth'});
 }
 if(gallery&&galleryPager){
  var galleryTicking=false;
  gallery.addEventListener('scroll',function(){
   if(galleryTicking)return;galleryTicking=true;
   requestAnimationFrame(function(){galleryTicking=false;updateGallery()});
  });
  document.querySelector('.gal-prev').addEventListener('click',function(){moveGallery(-1)});
  document.querySelector('.gal-next').addEventListener('click',function(){moveGallery(1)});
  window.addEventListener('resize',updateGallery);
  window.addEventListener('load',updateGallery);
  updateGallery();
 }

 var dlg=document.getElementById('lb'),items=[].slice.call(document.querySelectorAll('.gl'));
 if(!dlg||typeof dlg.showModal!=='function'||!items.length)return;
 var cur=0,big=document.getElementById('lbImg'),cnt=document.getElementById('lbCount');
 function show(i){
  cur=(i+items.length)%items.length;
  big.src=items[cur].getAttribute('data-full');
  big.alt=items[cur].querySelector('img').alt;
  cnt.textContent=(cur+1)+' / '+items.length;
 }
 items.forEach(function(b,i){b.addEventListener('click',function(){show(i);dlg.showModal()})});
 document.getElementById('lbPrev').addEventListener('click',function(){show(cur-1)});
 document.getElementById('lbNext').addEventListener('click',function(){show(cur+1)});
 document.getElementById('lbX').addEventListener('click',function(){dlg.close()});
 dlg.addEventListener('click',function(e){if(e.target===dlg)dlg.close()});
 dlg.addEventListener('keydown',function(e){if(e.key==='ArrowLeft')show(cur-1);if(e.key==='ArrowRight')show(cur+1)});
})();
</script>
</body>
</html>
