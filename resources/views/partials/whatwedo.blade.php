@php
 $w = config('whatwedo');
 $wi = [
  'calendar' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
  'users'    => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
  'star'     => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
 ];
@endphp
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
<style>
.wd{position:relative;overflow:hidden}
.wd-deco{position:absolute;right:-190px;top:-130px;width:580px;height:580px;border-radius:50%;background:radial-gradient(circle at 30% 70%,#e3f1f3,#f6fbfb 70%);border:1px solid #e0edef;pointer-events:none}
.wd .wrap{position:relative}
.wd h2,.wd h3,.wd h4{font-family:'Playfair Display',Georgia,serif;font-weight:700;letter-spacing:-.01em;color:var(--ink)}
.wd-eyebrow{display:inline-flex;align-items:center;gap:12px;font:600 12px Figtree,system-ui,sans-serif;letter-spacing:.16em;text-transform:uppercase;color:var(--teal-d)}
.wd-head{display:grid;grid-template-columns:1.15fr .85fr;gap:56px;align-items:center;margin-bottom:44px}
.wd-head .wd-eyebrow:after{content:"";width:34px;height:2px;background:var(--teal)}
.wd-head h2{font-size:clamp(32px,4.2vw,50px);line-height:1.12;margin:14px 0 18px}
.wd-sub{margin:0;color:var(--mute);max-width:30em}
.wd-side{border-left:2px solid var(--teal);padding-left:28px}
.wd-side p{margin:0 0 20px;color:var(--mute);max-width:26em}
.wd-side ul{list-style:none;margin:0;padding:0;display:flex;gap:32px;flex-wrap:wrap}
.wd-side li{display:flex;flex-direction:column;gap:8px;max-width:96px;font-size:13px;font-weight:600;line-height:1.3}
.wd-side svg{width:26px;height:26px;fill:none;stroke:var(--teal);stroke-width:1.7;stroke-linecap:round;stroke-linejoin:round}
.wd-tabs{display:flex;gap:10px;flex-wrap:wrap;align-items:center;margin-bottom:36px}
.wd-tabs:after{content:"";flex:1;min-width:40px;height:1px;background:var(--line)}
.wd-tab{font:600 14px Figtree,system-ui,sans-serif;padding:11px 24px;border-radius:999px;border:1px solid var(--line);background:#fff;color:var(--ink);cursor:pointer;transition:background .2s,border-color .2s,color .2s}
.wd-tab:hover{border-color:var(--teal)}
.wd-tab[aria-selected="true"]{background:var(--teal-d);border-color:var(--teal-d);color:#fff}
.wd-panel{display:none}
.wd-panel.on{display:block}
.wd-phead{margin-bottom:28px}
.wd-phead h3{font-size:clamp(26px,3vw,34px);line-height:1.2;margin:10px 0}
.wd-phead p{margin:0;color:var(--mute);max-width:38em;font-size:15px}
.wd-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:26px}
.wd-card{display:flex;flex-direction:column;background:#fff;border:1px solid #edf0f1;border-radius:10px;overflow:hidden;box-shadow:0 2px 16px rgba(20,40,45,.07);transition:transform .2s,box-shadow .2s}
.wd-card:hover{transform:translateY(-4px);box-shadow:0 16px 30px -16px rgba(20,60,70,.4)}
.wd-im{aspect-ratio:16/9.4;overflow:hidden;background:#222}
.wd-im img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
.wd-card:hover .wd-im img{transform:scale(1.04)}
.wd-tx{display:flex;flex-direction:column;gap:6px;flex:1;padding:16px 20px 18px}
.wd-cat{font:600 10.5px Figtree,system-ui,sans-serif;letter-spacing:.14em;text-transform:uppercase;color:var(--teal-d)}
.wd-card h4{margin:0;font-size:19px;line-height:1.25}
.wd-row{display:flex;justify-content:space-between;align-items:flex-end;gap:14px;margin-top:auto;padding-top:4px}
.wd-row p{margin:0;max-width:none;color:var(--mute);font-size:13.5px;line-height:1.5}
.wd-view{flex:none;display:inline-flex;align-items:center;gap:6px;padding:0;border:0;background:none;font:600 12.5px Figtree,system-ui,sans-serif;color:var(--teal-d);cursor:pointer;white-space:nowrap}
.wd-view svg{width:14px;height:14px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;transition:transform .2s}
.wd-view:hover svg{transform:translateX(3px)}
.wd-cta{display:flex;flex-direction:column;justify-content:center;min-height:250px;padding:36px 34px;border-radius:10px;background:linear-gradient(135deg,rgba(230,243,245,.97) 35%,rgba(170,214,220,.78)),var(--bg) right center/cover}
.wd-cta:before{content:"";width:34px;height:2px;margin-bottom:22px;background:var(--teal)}
.wd-cta h4{margin:0 0 10px;font-size:24px;line-height:1.25;color:var(--teal-d)}
.wd-cta h4 span{display:block}
.wd-cta p{margin:0 0 22px;color:var(--mute);font-size:15px}
.wd-cta a{align-self:flex-start;display:inline-flex;align-items:center;gap:8px;padding:11px 24px;border:1.5px solid var(--teal-d);border-radius:999px;background:rgba(255,255,255,.45);color:var(--teal-d);font:600 14px Figtree,system-ui,sans-serif;text-decoration:none}
.wd-cta a:hover{background:var(--teal-d);color:#fff}
.wd-cta svg{width:15px;height:15px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
/* lightbox */
.wd-dlg{position:fixed;border:0;padding:0;width:min(920px,92vw);max-height:92vh;overflow:auto;border-radius:14px;background:#fff;color:var(--ink)}
.wd-dlg::backdrop{background:rgba(15,20,22,.72)}
.wd-dlg img{display:block;width:100%;max-height:60vh;object-fit:cover;background:#222}
.wd-dbody{padding:22px 28px 24px}
.wd-dbody h4{margin:6px 0 8px;font:700 26px/1.2 'Playfair Display',Georgia,serif}
.wd-dbody p{margin:0;color:var(--mute)}
.wd-nav{display:flex;align-items:center;justify-content:flex-end;gap:14px;margin-top:18px;font:600 14px Figtree,system-ui,sans-serif}
.wd-nav button{display:grid;place-items:center;width:42px;height:42px;border-radius:50%;border:1px solid var(--line);background:#fff;color:var(--ink);cursor:pointer}
.wd-nav button:hover{border-color:var(--teal);color:var(--teal-d)}
.wd-nav svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.wd-x{position:absolute;top:12px;right:12px;z-index:2;width:38px;height:38px;border:0;border-radius:50%;background:rgba(255,255,255,.92);font-size:22px;line-height:1;cursor:pointer;color:var(--ink)}
@media (max-width:980px){.wd-grid{grid-template-columns:1fr 1fr}.wd-head{grid-template-columns:1fr;gap:28px}}
@media (max-width:620px){.wd-grid{grid-template-columns:1fr}.wd-deco{width:380px;height:380px;right:-160px}.wd-side ul{gap:24px}}
@media (prefers-reduced-motion:reduce){.wd-card,.wd-im img,.wd-view svg,.wd-tab{transition:none}}
</style>

<section class="wd" id="services">
 <div class="wd-deco" aria-hidden="true"></div>
 <div class="wrap">
  <div class="wd-head">
   <div>
    <span class="wd-eyebrow">{{ $w['head']['eyebrow'] }}</span>
    <h2>{{ $w['head']['title'] }}</h2>
    <p class="wd-sub">{{ $w['head']['text'] }}</p>
   </div>
   <div class="wd-side">
    <p>{{ $w['head']['side'] }}</p>
    <ul>
     @foreach($w['head']['points'] as [$icon, $label])
      <li><svg viewBox="0 0 24 24" aria-hidden="true">{!! $wi[$icon] ?? '' !!}</svg><span>{{ $label }}</span></li>
     @endforeach
    </ul>
   </div>
  </div>

  <div class="wd-tabs" role="tablist">
   @foreach($w['services'] as $i => $s)
    <button type="button" class="wd-tab" role="tab" aria-selected="{{ $i === 0 ? 'true' : 'false' }}">{{ $s['tab'] }}</button>
   @endforeach
  </div>

  @foreach($w['services'] as $i => $s)
   <div class="wd-panel {{ $i === 0 ? 'on' : '' }}" role="tabpanel">
    <div class="wd-phead">
     <span class="wd-eyebrow">{{ $s['tab'] }}</span>
     <h3>{{ $s['heading'] }}</h3>
     <p>{{ $s['text'] }}</p>
    </div>
    <div class="wd-grid">
     @foreach($s['projects'] as [$title, $desc, $photo, $cat])
      <article class="wd-card">
       <div class="wd-im"><img src="{{ asset('images/'.$photo.'.jpg') }}" alt="{{ $title }}" loading="lazy"></div>
       <div class="wd-tx">
        <span class="wd-cat">{{ $cat }}</span>
        <h4>{{ $title }}</h4>
        <div class="wd-row">
         <p>{{ $desc }}</p>
         <button type="button" class="wd-view">View project <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg></button>
        </div>
       </div>
      </article>
     @endforeach
     <aside class="wd-cta" style="--bg:url('{{ asset('images/'.$w['head']['cta']['photo'].'.jpg') }}')">
      <h4>@foreach($w['head']['cta']['lines'] as $line)<span>{{ $line }}</span>@endforeach</h4>
      <p>{{ $w['head']['cta']['text'] }}</p>
      <a href="#contact">{{ $w['head']['cta']['button'] }} <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
     </aside>
    </div>
   </div>
  @endforeach
 </div>
</section>

<dialog class="wd-dlg" id="wdDlg" aria-label="Project preview">
 <button type="button" class="wd-x" aria-label="Close">&times;</button>
 <img id="wdImg" src="" alt="">
 <div class="wd-dbody">
  <span class="wd-cat" id="wdCat"></span>
  <h4 id="wdTitle"></h4>
  <p id="wdDesc"></p>
  <div class="wd-nav">
   <button type="button" id="wdPrev" aria-label="Previous project"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg></button>
   <span id="wdCount"></span>
   <button type="button" id="wdNext" aria-label="Next project"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg></button>
  </div>
 </div>
</dialog>

<script>
(function(){
 var tabs=document.querySelectorAll('.wd-tab'),panels=document.querySelectorAll('.wd-panel');
 tabs.forEach(function(t,i){t.addEventListener('click',function(){
  tabs.forEach(function(x){x.setAttribute('aria-selected',x===t?'true':'false')});
  panels.forEach(function(p,j){p.classList.toggle('on',j===i)});
 })});
 var dlg=document.getElementById('wdDlg');
 if(!dlg||typeof dlg.showModal!=='function'){document.querySelectorAll('.wd-view').forEach(function(b){b.hidden=true});return;}
 var list=[],cur=0,img=document.getElementById('wdImg'),cat=document.getElementById('wdCat'),
  ttl=document.getElementById('wdTitle'),dsc=document.getElementById('wdDesc'),cnt=document.getElementById('wdCount');
 function show(i){
  cur=(i+list.length)%list.length;
  var c=list[cur],im=c.querySelector('img');
  img.src=im.currentSrc||im.src;img.alt=im.alt;
  cat.textContent=c.querySelector('.wd-cat').textContent;
  ttl.textContent=c.querySelector('h4').textContent;
  dsc.textContent=c.querySelector('.wd-row p').textContent;
  cnt.textContent=(cur+1)+' / '+list.length;
 }
 document.querySelectorAll('.wd-view').forEach(function(b){b.addEventListener('click',function(){
  var card=b.closest('.wd-card');
  list=[].slice.call(card.closest('.wd-panel').querySelectorAll('.wd-card'));
  show(list.indexOf(card));dlg.showModal();
 })});
 document.getElementById('wdPrev').addEventListener('click',function(){show(cur-1)});
 document.getElementById('wdNext').addEventListener('click',function(){show(cur+1)});
 dlg.querySelector('.wd-x').addEventListener('click',function(){dlg.close()});
 dlg.addEventListener('click',function(e){if(e.target===dlg)dlg.close()});
 dlg.addEventListener('keydown',function(e){if(e.key==='ArrowLeft')show(cur-1);if(e.key==='ArrowRight')show(cur+1)});
})();
</script>
