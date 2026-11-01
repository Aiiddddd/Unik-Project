<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
@include('partials.seo')
<!-- <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Cpath d='M0 32V0h32v32z' fill='%23F68F1E'/%3E%3Ccircle cx='16' cy='16' r='7' fill='%230F8899'/%3E%3C/svg%3E"> -->
<link rel="icon" type="image/png" href="{{  asset('images/favicon-unik-full.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;0,700;0,800;1,500&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{--bg:#fff;--ink:#231f20;--mute:#5b5657;--teal:#1a8a98;--teal-d:#126f7c;--or:#1a8a98;--line:#e2e6e7;color-scheme:light;
box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px)}
html{scroll-behavior:smooth;scroll-padding-top:calc(76px + env(safe-area-inset-top,0px))}
*,*:before,*:after{box-sizing:border-box}
body{margin:0;background:var(--bg);color:var(--ink);font:400 17px/1.65 Figtree,system-ui,sans-serif}
h1,h2,h3{font-family:"Times New Roman",Times,serif,system-ui,sans-serif;line-height:1.1;margin:0}
a{color:inherit}
img,svg{max-width:100%}
img{display:block}
.wrap{max-width:1120px;margin:0 auto;padding:0 22px}
section{padding:88px 0}
section[id]{scroll-margin-top:90px}
:focus-visible{outline:3px solid var(--teal);outline-offset:3px}
header{position:sticky;top:env(safe-area-inset-top,0px);z-index:9;background:rgba(255,255,255,.95);backdrop-filter:blur(8px);border-bottom:1px solid var(--line)}
.bar{display:flex;align-items:center;justify-content:space-between;height:72px}
.logo{display:flex;align-items:center;text-decoration:none}
.logo img{height:36px;width:auto}
nav{display:flex;gap:26px;align-items:center;font-weight:600;font-size:15px}
nav a{text-decoration:none}
nav a:not(.btn):hover{color:var(--teal-d)}
.btn{display:inline-block;background:var(--or);color:var(--ink);font:700 15px Montserrat,sans-serif;padding:14px 26px;border-radius:999px 999px 999px 6px;text-decoration:none;border:2px solid var(--or);cursor:pointer;transition:transform .15s}
.btn:hover{transform:translateY(-2px)}
.btn.ghost{background:none;border-color:var(--teal);color:var(--teal-d)}
.btn.ghost:hover{background:var(--teal-d);border-color:var(--teal-d);color:#fff}
.menu{display:none;background:none;border:0;font-size:26px;color:var(--ink);cursor:pointer}
/* hero */
/* .hero{position:relative;color:#fff;text-align:center;display:flex;align-items:center;justify-content:center;min-height:calc(100vh - 72px);min-height:calc(100svh - 72px);padding:96px 0;background:linear-gradient(rgba(18,16,17,.58),rgba(18,16,17,.58)),var(--hero) center/cover no-repeat} */
.hero{position:relative;color:#fff;text-align:center;display:flex;align-items:flex-end;justify-content:center;min-height:calc(100vh - 72px);min-height:calc(100svh - 72px);padding:96px 0 80px;background-image:linear-gradient(to bottom,rgba(18,16,17,.05) 0%,rgba(18,16,17,.08) 28%,rgba(18,16,17,.6) 45%,rgba(18,16,17,.78) 100%),var(--hero);background-size:100% 100%,cover;background-position:0 0,center 68%;background-repeat:no-repeat}
.hero .wrap{display:flex;flex-direction:column;align-items:center}
.hero h1{font-family:"Times New Roman",Times,serif;font-style:italic;font-size:clamp(32px,8vw,92px);font-weight:400;letter-spacing:0;line-height:1.08;text-shadow:0 2px 24px rgba(0,0,0,.45)}
.hero h1 span{display:block;white-space:nowrap}
.hero h1 span:last-child{font-style:italic}
.hero p{font-size:clamp(17px,2vw,21px);max-width:36em;margin:22px auto 34px;color:#f3efef}
.hero .acts{justify-content:center}
.hero .btn.ghost{border-color:#fff;color:#fff}
.hero .btn.ghost:hover{background:#fff;color:var(--ink);border-color:#fff}
.wa{position:fixed;right:max(18px,env(safe-area-inset-right,0px));bottom:max(18px,env(safe-area-inset-bottom,0px));z-index:8;width:58px;height:58px;display:grid;place-items:center;background:#25d366;color:#fff;border-radius:50%;text-decoration:none;box-shadow:0 6px 18px rgba(0,0,0,.25);transition:transform .15s ease,box-shadow .15s ease}.wa:hover{transform:translateY(-2px);box-shadow:0 10px 22px rgba(0,0,0,.28)}.wa svg{width:26px;height:26px;display:block;fill:currentColor}
/* about */
.about .wrap{display:grid;grid-template-columns:1fr 1fr;gap:56px;align-items:start}
h2{font-size:clamp(30px,4vw,46px);font-weight:800;letter-spacing:-.8px;margin-bottom:22px}
.rule{width:64px;height:2px;background:var(--or);margin-bottom:24px;border-radius:2px}
.lead{font-size:19px;color:var(--mute);max-width:34em}
.belief{background:var(--teal-d);color:#fff;padding:36px;border-radius:0 0 0 70px}
.belief h3{font-size:24px;margin-bottom:12px}
.belief p{margin:0}
/* services */
.tabs{display:flex;gap:10px;flex-wrap:wrap;margin:8px 0 28px}
.tab{font:700 15px Montserrat,sans-serif;padding:12px 22px;border-radius:999px;border:2px solid var(--line);background:none;color:var(--ink);cursor:pointer}
.tab:hover{border-color:var(--teal)}
.tab[aria-selected="true"]{background:var(--teal-d);border-color:var(--teal-d);color:#fff}
.panel{display:none;grid-template-columns:1fr 1.2fr;gap:40px;align-items:center}
.panel.on{display:grid}
.panel h3{font-size:30px;color:var(--teal);margin-bottom:14px}
.panel ul{padding-left:20px;color:var(--mute)}
.mosaic{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}
.mosaic figure{margin:0;aspect-ratio:1;border-radius:18px 18px 18px 4px;overflow:hidden;background:#222}
.mosaic figure:first-child{grid-column:span 2;grid-row:span 2;border-radius:18px 18px 18px 60px}
.mosaic img{width:100%;height:100%;object-fit:cover}
/* portfolio */
.filters{display:flex;gap:10px;flex-wrap:wrap;margin:8px 0 28px}
.chip{font:600 14px Figtree,sans-serif;padding:9px 18px;border-radius:999px;border:2px solid var(--line);background:none;color:var(--ink);cursor:pointer}
.chip:hover{border-color:var(--or)}
.chip[aria-pressed="true"]{background:var(--or);border-color:var(--or);color:var(--ink)}
.grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
.card{background:#fff;border-radius:22px 22px 22px 4px;overflow:hidden;border:1px solid var(--line);border-bottom:4px solid var(--teal)}
.card .im{aspect-ratio:16/10;background:#222}
.card .im img{width:100%;height:100%;object-fit:cover}
.card .tx{padding:18px 20px 22px}
.card h3{font-size:18px;margin-bottom:6px}
.card p{margin:0;color:var(--mute);font-size:15px}
.card[hidden]{display:none}
/* why choose us */
.why .head{text-align:center;max-width:46em;margin:0 auto 48px}
.why .head .rule{margin-left:auto;margin-right:auto}
.why .head .lead{margin:0 auto}
.why-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
.why-card{background:#fff;border:1px solid var(--line);border-radius:22px 22px 22px 4px;padding:32px;transition:border-color .2s,box-shadow .2s}
.why-card:hover{border-color:var(--teal);box-shadow:0 14px 30px -18px rgba(18,111,124,.5)}
.why-card .ic{width:56px;height:56px;border-radius:14px;background:#e6f3f5;color:var(--teal-d);display:grid;place-items:center;margin-bottom:22px}
.why-card svg{width:28px;height:28px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.why-card h3{font-size:21px;color:var(--teal);margin-bottom:12px}
.why-card p{margin:0;color:var(--mute);font-size:16px}
@media (max-width:860px){.why-grid{grid-template-columns:1fr}}
/* team */
.team{display:grid;grid-template-columns:repeat(4,1fr);gap:26px;margin-top:34px}
.mem{text-align:center}
.mem img{width:118px;height:118px;border-radius:50%;margin:0 auto 14px;object-fit:cover;border:2px solid var(--or)}
.mem b{display:block;font-family:Montserrat,sans-serif}
.mem span{color:var(--mute);font-size:15px}
//* clients logos */
.clients .head{text-align:left;max-width:46em;margin:0 0 44px}
.clients .head .rule{margin-left:0;margin-right:auto}
.clients .head .lead{width:100%;max-width:42em;margin:0;white-space:normal}
.lg{--k:1;display:block;flex:none;height:calc(var(--h) * var(--k) * 1px);background:#8b9a9e;-webkit-mask:var(--m) center/contain no-repeat;mask:var(--m) center/contain no-repeat;transition:background .25s}
.lg:hover{background:var(--teal)}
.marq{overflow:hidden;padding:40px 0;border-top:1px solid var(--line);border-bottom:1px solid var(--line);-webkit-mask-image:linear-gradient(90deg,transparent,#000 8%,#000 92%,transparent);mask-image:linear-gradient(90deg,transparent,#000 8%,#000 92%,transparent)}
.marq-track{display:flex;align-items:center;width:max-content;animation:marq 45s linear infinite}
.marq-track .lg{margin-right:72px}
.marq:hover .marq-track{animation-play-state:paused}
@keyframes marq{to{transform:translateX(-50%)}}
.collab-head{display:flex;align-items:center;gap:18px;margin:56px 0 32px;color:var(--mute);font-size:15px}
.collab-head:before,.collab-head:after{content:"";flex:1;height:1px;background:var(--line)}
.collab-row{display:flex;flex-wrap:wrap;justify-content:center;align-items:center;gap:28px 64px}
@media (max-width:860px){.clients .head{text-align:left}.clients .head .lead{max-width:100%}.lg{--k:.72}.marq-track .lg{margin-right:48px}.collab-row{gap:24px 40px}}
@media (prefers-reduced-motion:reduce){
 .marq{-webkit-mask-image:none;mask-image:none}
 .marq-track{animation:none;flex-wrap:wrap;justify-content:center;gap:28px 56px;width:auto;padding:0 22px}
 .marq-track .lg{margin-right:0}
 .marq-track .lg[aria-hidden="true"]{display:none}
}
/* contact */
.contact .wrap{display:grid;grid-template-columns:1fr 1fr;gap:56px}
.contact dl{margin:0}
.contact dt{font:700 15px Montserrat,sans-serif;margin-top:18px}
.contact dd{margin:2px 0 0;color:var(--mute)}
.contact dd a{color:var(--teal-d);font-weight:600}
form{display:grid;gap:14px}
label{font:600 14px Figtree,sans-serif}
input,textarea{width:100%;font:inherit;padding:13px 15px;border-radius:12px;border:2px solid var(--line);background:#fff;color:var(--ink);margin-top:5px}
input:focus,textarea:focus{border-color:var(--teal);outline:0}
.acts{display:flex;gap:12px;flex-wrap:wrap}
#note{font-size:14px;color:var(--mute);min-height:1.4em}
footer{border-top:4px solid var(--teal);color:var(--mute);padding:28px 0;font-size:14px}
footer .wrap{display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap}
@media (max-width:860px){
.hero{min-height:calc(100vh - 72px);min-height:calc(100svh - 72px);padding:0 0 48px;background-position:0 0,center 58%}
 section{padding:60px 0}
 .about .wrap,.panel.on,.contact .wrap{grid-template-columns:1fr}
 .grid{grid-template-columns:1fr 1fr}.team{grid-template-columns:1fr 1fr}.logos{grid-template-columns:1fr 1fr}
 .logo img{height:32px}
 .menu{display:block}
 nav{display:none;position:absolute;top:72px;left:0;right:0;background:#fff;flex-direction:column;align-items:flex-start;padding:18px 22px;border-bottom:1px solid var(--line)}
 nav.open{display:flex}
}
/* what we do: layanan + project jadi satu */
.panel.on{display:block}
.panel .intro{display:grid;grid-template-columns:1.1fr .9fr;gap:40px;align-items:start;margin-bottom:36px}
.panel .intro h3{font-size:30px;color:var(--teal);margin-bottom:12px}
.panel .intro p{margin:0;color:var(--mute);max-width:40em}
.panel .intro ul{margin:0;padding:0;list-style:none;display:grid;gap:10px}
.panel .intro li{border-left:4px solid var(--or);padding:4px 0 4px 16px;color:var(--ink)}
.panel .card h3{font-size:18px;color:var(--ink);margin-bottom:6px}
@media (max-width:860px){.panel .intro{grid-template-columns:1fr;gap:20px}}
@media (max-width:520px){.grid{grid-template-columns:1fr}}
@media (max-width:520px){.hero{background-position:0 0,54% center;padding-bottom:32px}}
@media (prefers-reduced-motion:reduce){html{scroll-behavior:auto}.btn{transition:none}}
</style>
</head>
<body>
<header><div class="wrap bar">
     <a class="logo" href="#top" aria-label="{{ $c['name'] }}"><img src="{{ asset('images/logo-unik-navbar@2x.png') }}" alt="{{ $c['name'] }}" width="459" height="118"></a>
 <button class="menu" aria-label="Menu" aria-expanded="false" id="mb">☰</button>
 <nav id="nav">
  <a href="#about">About</a><a href="#services">Services</a><a href="#why">Why us</a><a href="#clients">Clients</a><a href="#team">Team</a>
  <a class="btn" href="https://wa.me/{{ $c['contact']['whatsapp'] }}?text={{ rawurlencode('Hello UNIK Event Solutions, I would like to plan an event.') }}" target="_blank" rel="noopener">Contact us</a>
 </nav>
</div></header>

<main id="top">
<section class="hero" style="--hero:url('{{ asset('images/'.$c['hero']['photo'].'.jpg') }}')"><div class="wrap">
 <h1>@foreach($c['hero']['title'] as $line)<span>{{ $line }}</span>@endforeach</h1>
 <p>{{ $c['hero']['text'] }}</p>
 <div class="acts"><a class="btn" href="https://wa.me/{{ $c['contact']['whatsapp'] }}?text={{ rawurlencode('Hello UNIK Event Solutions, I would like to plan an event.') }}" target="_blank" rel="noopener">Plan your event</a><a class="btn ghost" href="#services">See our work</a></div>
</div></section>

<section class="about" id="about"><div class="wrap">
 <div>
  <h2>About us</h2><div class="rule"></div>
  <p class="lead">{{ $c['about'] }}</p>
 </div>
 <div class="belief">
  <h3>Our belief</h3>
  <p>{{ $c['belief'] }}</p>
 </div>
</div></section>

@include('partials.whatwedo')


<section class="why" id="why"><div class="wrap">
 @php
  $icons = [
   'landmark' => '<line x1="3" x2="21" y1="22" y2="22"/><line x1="6" x2="6" y1="18" y2="11"/><line x1="10" x2="10" y1="18" y2="11"/><line x1="14" x2="14" y1="18" y2="11"/><line x1="18" x2="18" y1="18" y2="11"/><polygon points="12 2 20 7 4 7"/>',
   'layers'   => '<path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83z"/><path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"/><path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"/>',
   'video'    => '<rect x="2" y="3" width="20" height="14" rx="2"/><polygon points="10 8 15 10 10 12"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/>',
   'palette'  => '<circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/><circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/><circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/><circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"/>',
   'chart'    => '<line x1="6" x2="6" y1="20" y2="15"/><line x1="12" x2="12" y1="20" y2="9"/><line x1="18" x2="18" y1="20" y2="4"/>',
   'users'    => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
  ];
 @endphp
 <div class="head">
  <h2>{{ $c['why']['title'] }}</h2><div class="rule"></div>
  <p class="lead">{{ $c['why']['text'] }}</p>
 </div>
 <div class="why-grid">
  @foreach($c['why']['items'] as [$icon, $title, $text])
   <article class="why-card">
    <div class="ic"><svg viewBox="0 0 24 24" aria-hidden="true">{!! $icons[$icon] ?? '' !!}</svg></div>
    <h3>{{ $title }}</h3>
    <p>{{ $text }}</p>
   </article>
  @endforeach
 </div>
</div></section>


<section class="clients" id="clients"><div class="wrap">
    @php
    // ukuran tiap logo disesuaikan bentuknya supaya bobot visualnya seimbang
    $logoH = fn($w, $h, $area = 5200) => (int) max(16, min(64, round(sqrt($area / ($w / $h))), floor(230 / ($w / $h))));
    @endphp
    <div class="head">
        <h2>Our clients</h2><div class="rule"></div>
        <p class="lead">Ministries, national agencies, and well-known brands have trusted UNIK to deliver their events.</p>
    </div>
</div>
<div class="marq">
    <div class="marq-track">
        @foreach([0, 1] as $pass)
        @foreach($c['clients'] as [$name, $file, $w, $h])
        <span class="lg" @if($pass) aria-hidden="true" @else role="img" aria-label="{{ $name }}" @endif style="--h:{{ $logoH($w, $h) }};aspect-ratio:{{ $w }}/{{ $h }};--m:url('{{ asset('images/clients/'.$file.'.png') }}')"></span>
        @endforeach
        @endforeach
    </div>
</div>
<div class="wrap">
    <div class="collab-head"><span>In collaboration with</span></div>
    <div class="collab-row">
        @foreach($c['collaborators'] as [$name, $file, $w, $h])
        <span class="lg" role="img" aria-label="{{ $name }}" style="--h:{{ $logoH($w, $h, 3800) }};aspect-ratio:{{ $w }}/{{ $h }};--m:url('{{ asset('images/clients/'.$file.'.png') }}')"></span>
        @endforeach
    </div>
</div></section>

@include('partials.team')

<footer><div class="wrap"><span>© {{ date('Y') }} {{ $c['legal'] }}</span><span>{{ $c['contact']['website'] }}</span></div></footer>

<a class="wa" href="https://wa.me/{{ $c['contact']['whatsapp'] }}?text={{ rawurlencode('Hello UNIK Event Solutions, I would like to discuss an event.') }}" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
 <svg viewBox="0 0 32 32" aria-hidden="true" focusable="false"><path d="M16 3.1C8.8 3.1 3 8.8 3 16c0 2.5.7 4.9 2 6.9L3 29l6.2-2.1c2 1.1 4.3 1.7 6.8 1.7 7.2 0 13.1-5.7 13.1-13.1S23.2 3.1 16 3.1zm0 22.6c-2.1 0-4.2-.6-6-1.7l-.4-.2-3.7 1.2 1.2-3.6-.2-.4A10.5 10.5 0 0 1 5.5 16c0-5.8 4.7-10.5 10.5-10.5s10.5 4.7 10.5 10.5-4.7 10.5-10.5 10.5zm5.8-7.8c-.3-.2-1.8-.9-2-.9-.2-.1-.4-.1-.6.1-.2.2-.7.9-.9 1.1-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.6-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.7.1-.1.2-.3.4-.4.1-.1.2-.3.3-.5.1-.2.1-.3 0-.5-.1-.2-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.8.3-.3.3-1 1-1 2.4s1 2.8 1.2 3c.2.2 2.1 3.2 5.1 4.4.7.3 1.3.5 1.8.6.7.2 1.3.2 1.8.1.6-.1 1.8-.7 2-.9.2-.2.3-.4.4-.6.1-.2.1-.5 0-.7-.1-.2-.3-.2-.7-.4z"/></svg>
</a>
<script>
var MAIL=@json($c['contact']['email']), WA=@json($c['contact']['whatsapp']);
document.querySelectorAll('.chip').forEach(function(b){b.onclick=function(){
 document.querySelectorAll('.chip').forEach(function(x){x.setAttribute('aria-pressed',x===b)});
 document.querySelectorAll('.card').forEach(function(c){c.hidden=b.dataset.f!=='all'&&c.dataset.c!==b.dataset.f})}});
document.querySelectorAll('.tab').forEach(function(t){t.onclick=function(){
 document.querySelectorAll('.tab').forEach(function(x){x.setAttribute('aria-selected',x===t)});
 document.querySelectorAll('.panel').forEach(function(p,i){p.classList.toggle('on',i==t.dataset.p)})}});
var mb=document.getElementById('mb'),nv=document.getElementById('nav');
mb.onclick=function(){var o=nv.classList.toggle('open');mb.setAttribute('aria-expanded',o)};
nv.onclick=function(){nv.classList.remove('open');mb.setAttribute('aria-expanded',false)};
document.querySelectorAll('a[href^="#"]').forEach(function(link){
 link.addEventListener('click',function(e){
  var target=document.querySelector(link.getAttribute('href'));
  if(!target)return;
  e.preventDefault();
  target.scrollIntoView({behavior:'smooth',block:'start'});
  history.replaceState(null,'',link.getAttribute('href'));
 });
});
var f=document.getElementById('cf');
function txt(){return 'Hello UNIK, I am '+f.n.value+' ('+f.c.value+'). '+f.m.value}
f.onsubmit=function(e){e.preventDefault();
 location.href='mailto:'+MAIL+'?subject='+encodeURIComponent('Event inquiry from '+f.n.value)+'&body='+encodeURIComponent(txt());
 document.getElementById('note').textContent='Opening your email app. If nothing opens, write to '+MAIL+'.'};
document.getElementById('wa').onclick=function(){
 if(!f.reportValidity())return;window.open('https://wa.me/'+WA+'?text='+encodeURIComponent(txt()),'_blank','noopener')};
</script>
</body>
</html>
