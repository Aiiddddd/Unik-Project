@php
 $curLang = $lang ?? app()->getLocale();
 $altUrls = $alt ?? ['en' => '/', 'id' => '/id'];
@endphp
<div class="lang" role="group" aria-label="Language">
 <a href="{{ $altUrls['en'] }}" hreflang="en" lang="en" @if($curLang === 'en') aria-current="true" @endif>EN</a>
 <span aria-hidden="true">|</span>
 <a href="{{ $altUrls['id'] }}" hreflang="id" lang="id" @if($curLang === 'id') aria-current="true" @endif>ID</a>
</div>
<style>
.lang{display:flex;align-items:center;gap:8px;font:600 14px Montserrat,system-ui,sans-serif}
.lang a{padding:2px 0;color:var(--mute);text-decoration:none;border-bottom:2px solid transparent}
.lang a:hover{color:var(--teal-d)}
.lang a[aria-current]{color:var(--teal-d);border-bottom-color:var(--teal)}
.lang span{color:#c9d0d1}
</style>
