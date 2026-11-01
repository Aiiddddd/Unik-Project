@php
 $tq    = config('team_quote', []);
 $qHead = $tq['heading'] ?? 'We are what we repeatedly do.';
 $qText = $tq['text'] ?? 'Excellence, then, is not an act, but a habit.';
 $qBy   = $tq['author'] ?? 'Aristotle';
 $qPic  = $tq['photo'] ?? 'team-group';
 $qBtn  = array_key_exists('button', $tq) ? $tq['button'] : ['label' => 'Work with our team', 'href' => '#contact'];
@endphp
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
<style>
.tm-grid{display:grid;grid-template-columns:1.5fr 1fr;gap:56px;align-items:stretch}
.tm-main{text-align:left}
.tm-list{display:grid;grid-template-columns:repeat(auto-fill,minmax(128px,1fr));gap:32px 24px;margin-top:40px}
.tm-mem{text-align:left}
.tm-mem img{display:block;width:112px;height:112px;margin:0 0 14px;border-radius:50%;object-fit:cover;border:4px solid var(--or)}
.tm-mem b{display:block;font-family:Montserrat,system-ui,sans-serif;line-height:1.3}
.tm-mem span{display:block;margin-top:2px;color:var(--mute);font-size:15px;line-height:1.4}
.tq{position:relative;overflow:hidden;margin:0;display:flex;flex-direction:column;justify-content:center;align-items:flex-start;min-height:360px;padding:40px 36px;border-radius:10px;text-align:left;background:linear-gradient(135deg,rgba(230,243,245,.97) 35%,rgba(170,214,220,.78)),var(--bg) center/cover}
.tq:before{content:"";width:34px;height:2px;margin-bottom:24px;background:var(--teal)}
.tq blockquote{margin:0}
.tq-h{display:block;margin-bottom:12px;font:700 clamp(24px,2.4vw,30px)/1.25 'Playfair Display',Georgia,serif;color:var(--teal-d);text-wrap:balance}
.tq blockquote p{margin:0;color:var(--mute);font-size:16px}
.tq figcaption{margin-top:12px;font:italic 500 15px Figtree,system-ui,sans-serif;color:#c4531a}
.tq a{display:inline-flex;align-items:center;gap:8px;margin-top:26px;padding:11px 24px;border:1.5px solid var(--teal-d);border-radius:999px;background:rgba(255,255,255,.45);color:var(--teal-d);font:600 14px Figtree,system-ui,sans-serif;text-decoration:none}
.tq a:hover{background:var(--teal-d);color:#fff}
.tq a svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
@media (max-width:900px){.tm-grid{grid-template-columns:1fr;gap:40px}.tq{min-height:260px;padding:32px 28px}}
</style>

<section id="team"><div class="wrap tm-grid">
 <div class="tm-main">
  <h2>{{ __('site.team') }}</h2><div class="rule"></div>
  <p class="lead">{{ $c['team_text'] ?? '' }}</p>
  <div class="tm-list">
   @foreach(($c['team'] ?? []) as [$name, $role, $photo])
    <div class="tm-mem">
     <img src="{{ asset('images/team/'.$photo.'.jpg') }}" alt="{{ $name }}" loading="lazy">
     <b>{{ $name }}</b>
     <span>{{ $role }}</span>
    </div>
   @endforeach
  </div>
 </div>
 <figure class="tq" style="--bg:url('{{ asset('images/'.$qPic.'.jpg') }}')">
  <blockquote>
   <strong class="tq-h">{{ $qHead }}</strong>
   <p>{{ $qText }}</p>
  </blockquote>
  <figcaption>-{{ $qBy }}</figcaption>
  @if($qBtn)
   @php
    $qHref = !empty($qBtn['whatsapp'])
     ? 'https://wa.me/'.$c['contact']['whatsapp'].'?text='.rawurlencode('Halo UNIK Event Solutions, saya ingin berdiskusi tentang acara.')
     : $qBtn['href'];
   @endphp
   <a href="{{ $qHref }}" @if(!empty($qBtn['whatsapp'])) target="_blank" rel="noopener" @endif>{{ $qBtn['label'] }} <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
  @endif
 </figure>
</div></section>
