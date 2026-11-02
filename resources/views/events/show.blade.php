<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
@include('partials.seo')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700;800&family=Figtree:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
<style>
:root{--ink:#231f20;--mute:#5b5657;--teal:#1a8a98;--teal-d:#126f7c;--or:#ea6b2d;--line:#e2e6e7;color-scheme:light}
*,*:before,*:after{box-sizing:border-box}
html{scroll-behavior:smooth}
body{margin:0;background:#fff;color:var(--ink);font:400 17px/1.7 Figtree,system-ui,sans-serif}
h1,h2,h3,h4{font-family:'Playfair Display',Georgia,serif;margin:0;line-height:1.15;color:var(--ink)}
a{color:inherit}
img{display:block;max-width:100%}
:focus-visible{outline:3px solid var(--teal);outline-offset:3px}
.wrap{max-width:1120px;margin:0 auto;padding:0 22px}
header{position:sticky;top:0;z-index:20;background:rgba(255,255,255,.95);backdrop-filter:blur(8px);border-bottom:1px solid var(--line)}
.bar{display:flex;align-items:center;justify-content:space-between;height:72px;gap:24px}
.logo img{height:36px;width:auto}
nav{display:flex;gap:26px;align-items:center;font:600 15px Montserrat,system-ui,sans-serif}
nav a{text-decoration:none}
nav a:not(.btn):hover{color:var(--teal-d)}
.btn{display:inline-block;background:var(--or);color:var(--ink);font:700 15px Montserrat,system-ui,sans-serif;padding:14px 26px;border:2px solid var(--or);border-radius:999px 999px 999px 6px;text-decoration:none;cursor:pointer;transition:transform .15s}
.btn:hover{transform:translateY(-2px)}
.btn.ghost{background:none;border-color:var(--teal);color:var(--teal-d)}
.btn.ghost:hover{background:var(--teal-d);border-color:var(--teal-d);color:#fff}
.menu{display:none;background:none;border:0;font-size:26px;color:var(--ink);cursor:pointer}

.ev-hero{position:relative;display:flex;align-items:flex-end;min-height:min(68vh,540px);padding:96px 0 52px;color:#fff;background:linear-gradient(to top,rgba(14,16,17,.86) 6%,rgba(14,16,17,.3) 62%,rgba(14,16,17,.4)),var(--img) center/cover no-repeat #222}
.ev-hero .wrap{width:100%}
.crumb{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;font-size:14px;color:rgba(255,255,255,.85)}
.crumb a{text-decoration:none}
.crumb a:hover{text-decoration:underline}
.ev-cat{display:block;margin-bottom:12px;font:600 12px Figtree,system-ui,sans-serif;letter-spacing:.16em;text-transform:uppercase;color:#bfe6ec}
.ev-hero h1{color:#fff;font-size:clamp(32px,5vw,56px);max-width:18em;text-wrap:balance}
.ev-hero p{margin:16px 0 0;max-width:40em;font-size:19px;color:rgba(255,255,255,.92)}

.ev-body{display:grid;grid-template-columns:1fr 340px;gap:56px;padding:64px 0}
.prose{font-size:18px;min-width:0}
.prose>*:first-child{margin-top:0}
.prose h2{font-size:30px;margin:1.6em 0 .5em}
.prose h3{font-size:24px;margin:1.4em 0 .4em}
.prose p{margin:0 0 1.1em}
.prose ul,.prose ol{margin:0 0 1.1em;padding-left:1.3em}
.prose li{margin:.3em 0}
.prose img{border-radius:10px;margin:1.4em 0}
.prose a{color:var(--teal-d);text-decoration:underline}
.prose blockquote{margin:1.4em 0;padding:4px 0 4px 20px;border-left:4px solid var(--or);color:var(--mute)}
.ev-aside{align-self:start;position:sticky;top:96px;padding:26px;border:1px solid var(--line);border-radius:12px;box-shadow:0 2px 16px rgba(20,40,45,.07)}
.ev-aside h2{font-size:20px;margin-bottom:18px}
.ev-aside dl{margin:0}
.ev-aside dt{font:600 11px Figtree,system-ui,sans-serif;letter-spacing:.14em;text-transform:uppercase;color:var(--teal-d)}
.ev-aside dd{margin:2px 0 16px;font-size:16px}
.ev-aside .btn{display:block;text-align:center;margin-top:8px}

.sec{padding:0 0 64px}
.sec h2{font-size:clamp(26px,3vw,34px);margin-bottom:24px}
.gal{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
.gl{padding:0;border:0;background:#222;border-radius:10px;overflow:hidden;cursor:zoom-in;aspect-ratio:4/3}
.gl img{width:100%;height:100%;object-fit:cover;transition:transform .4s}
.gl:hover img{transform:scale(1.04)}
.rel{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
.rc{display:flex;flex-direction:column;border:1px solid #edf0f1;border-radius:10px;overflow:hidden;box-shadow:0 2px 16px rgba(20,40,45,.07);text-decoration:none;color:inherit;transition:transform .2s,box-shadow .2s}
.rc:hover{transform:translateY(-4px);box-shadow:0 16px 30px -16px rgba(20,60,70,.4)}
.rc .im{aspect-ratio:16/9.4;background:#222;overflow:hidden}
.rc .im img{width:100%;height:100%;object-fit:cover}
.rc .tx{padding:16px 20px 20px}
.rc .cat{font:600 10.5px Figtree,system-ui,sans-serif;letter-spacing:.14em;text-transform:uppercase;color:var(--teal-d)}
.rc h3{font-size:19px;margin:6px 0}
.rc p{margin:0;color:var(--mute);font-size:14px;line-height:1.5}
.cta{display:flex;align-items:center;justify-content:space-between;gap:28px;flex-wrap:wrap;margin-bottom:64px;padding:44px 40px;border-radius:12px;background:linear-gradient(135deg,#e6f3f5 35%,#b4dbe0)}
.cta h2{font-size:clamp(24px,3vw,32px);color:var(--teal-d)}
.cta p{margin:8px 0 0;color:var(--mute)}
.back{display:inline-block;margin:0 0 56px;font-weight:600;color:var(--teal-d);text-decoration:none}
.back:hover{text-decoration:underline}
footer{border-top:4px solid var(--teal);padding:28px 0;font-size:14px;color:var(--mute)}
footer .wrap{display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap}
.wa{position:fixed;right:max(18px,env(safe-area-inset-right,0px));bottom:max(18px,env(safe-area-inset-bottom,0px));z-index:8;padding:12px 18px;border-radius:999px;background:#25d366;color:#0b3d1d;font:700 14px Montserrat,system-ui,sans-serif;text-decoration:none;box-shadow:0 6px 18px rgba(0,0,0,.25)}

.lb{position:fixed;border:0;padding:0;width:min(1000px,94vw);max-height:92vh;border-radius:12px;background:#111;color:#fff;overflow:hidden}
.lb::backdrop{background:rgba(10,12,13,.82)}
.lb img{width:100%;max-height:80vh;object-fit:contain;background:#111}
.lb-bar{display:flex;align-items:center;justify-content:space-between;gap:14px;padding:12px 18px;font:600 14px Figtree,system-ui,sans-serif}
.lb-bar div{display:flex;gap:10px}
.lb button{width:40px;height:40px;border-radius:50%;border:1px solid rgba(255,255,255,.35);background:transparent;color:#fff;font-size:20px;cursor:pointer}
.lb button:hover{background:rgba(255,255,255,.15)}

@media (max-width:900px){
 .ev-body{grid-template-columns:1fr;gap:36px;padding:44px 0}
 .ev-aside{position:static}
 .gal,.rel{grid-template-columns:1fr 1fr}
 .menu{display:block}
 nav{display:none;position:absolute;top:72px;left:0;right:0;flex-direction:column;align-items:flex-start;padding:18px 22px;background:#fff;border-bottom:1px solid var(--line)}
 nav.open{display:flex}
}
@media (max-width:560px){.gal,.rel{grid-template-columns:1fr}.cta{padding:32px 26px}}
@media (prefers-reduced-motion:reduce){html{scroll-behavior:auto}.btn,.rc,.gl img{transition:none}}
</style>
</head>
<body>

<header><div class="wrap bar">
 <a class="logo" href="{{ route('home') }}" aria-label="{{ $c['name'] }}"><img src="{{ asset('images/logo-unik.png') }}" alt="{{ $c['name'] }}" width="459" height="118"></a>
 <button class="menu" id="mb" aria-label="Menu" aria-expanded="false">☰</button>
 <nav id="nav">
  <a href="{{ route('home') }}#about">About</a>
  <a href="{{ route('home') }}#services">Services</a>
  <a href="{{ route('home') }}#why">Why us</a>
  <a href="{{ route('home') }}#team">Team</a>
  <a href="{{ route('home') }}#clients">Clients</a>
  <a class="btn" href="{{ route('home') }}#contact">Contact us</a>
 </nav>
</div></header>

<main>
 <section class="ev-hero" style="--img:url('{{ $project->cover_url }}')">
  <div class="wrap">
   <div class="crumb">
    <a href="{{ route('home') }}#services">What we do</a><span>/</span>
    <a href="{{ route('home') }}#services">{{ $service['tab'] ?? 'Events' }}</a>
   </div>
   @if($project->category)<span class="ev-cat">{{ $project->category }}</span>@endif
   <h1>{{ $project->title }}</h1>
   @if($project->summary)<p>{{ $project->summary }}</p>@endif
  </div>
 </section>

 <div class="wrap">
  <div class="ev-body">
   <article class="prose">
    @if($project->content)
     {!! str($project->content)->sanitizeHtml() !!}
    @else
     <p>{{ $project->summary }}</p>
    @endif
   </article>

   <aside class="ev-aside">
    <h2>Event details</h2>
    <dl>
     @if($service)<dt>Service</dt><dd>{{ $service['tab'] }}</dd>@endif
     @if($project->client)<dt>Client</dt><dd>{{ $project->client }}</dd>@endif
     @if($project->period)<dt>Period</dt><dd>{{ $project->period }}</dd>@endif
     @if($project->location)<dt>Location</dt><dd>{{ $project->location }}</dd>@endif
    </dl>
    <a class="btn" href="{{ route('home') }}#contact">Plan a similar event</a>
   </aside>
  </div>

  @if(count($project->gallery_urls))
   <section class="sec">
    <h2>Gallery</h2>
    <div class="gal">
     @foreach($project->gallery_urls as $i => $url)
      <button type="button" class="gl" data-full="{{ $url }}" aria-label="Open photo {{ $i + 1 }}"><img src="{{ $url }}" alt="{{ $project->title }} photo {{ $i + 1 }}" loading="lazy"></button>
     @endforeach
    </div>
   </section>
  @endif

  @if($related->count())
   <section class="sec">
    <h2>More in {{ $service['tab'] ?? 'this category' }}</h2>
    <div class="rel">
     @foreach($related as $r)
      <a class="rc" href="{{ route('events.show', $r) }}">
       <div class="im"><img src="{{ $r->cover_url }}" alt="{{ $r->title }}" loading="lazy"></div>
       <div class="tx">
        @if($r->category)<span class="cat">{{ $r->category }}</span>@endif
        <h3>{{ $r->title }}</h3>
        <p>{{ $r->summary }}</p>
       </div>
      </a>
     @endforeach
    </div>
   </section>
  @endif

  <div class="cta">
   <div>
    <h2>Every event is a new story.</h2>
    <p>Let's create yours together.</p>
   </div>
   <a class="btn ghost" href="{{ route('home') }}#contact">Contact us</a>
  </div>

  <a class="back" href="{{ route('home') }}#services">&larr; Back to What we do</a>
 </div>
</main>

<footer><div class="wrap"><span>© {{ date('Y') }} {{ $c['legal'] }}</span><span>{{ $c['contact']['website'] ?? '' }}</span></div></footer>

<a class="wa" href="https://wa.me/{{ $c['contact']['whatsapp'] ?? '' }}?text={{ rawurlencode('Hello UNIK Event Solutions, I would like to discuss an event.') }}" target="_blank" rel="noopener">Chat on WhatsApp</a>

<dialog class="lb" id="lb" aria-label="Photo viewer">
 <img id="lbImg" src="" alt="">
 <div class="lb-bar">
  <span id="lbCount"></span>
  <div>
   <button type="button" id="lbPrev" aria-label="Previous photo">&lsaquo;</button>
   <button type="button" id="lbNext" aria-label="Next photo">&rsaquo;</button>
   <button type="button" id="lbX" aria-label="Close">&times;</button>
  </div>
 </div>
</dialog>

<script>
(function(){
 var mb=document.getElementById('mb'),nv=document.getElementById('nav');
 mb.addEventListener('click',function(){var o=nv.classList.toggle('open');mb.setAttribute('aria-expanded',o)});
 nv.addEventListener('click',function(){nv.classList.remove('open');mb.setAttribute('aria-expanded','false')});

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
