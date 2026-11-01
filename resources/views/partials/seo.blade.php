@php
 $seo     = config('seo');
 $base    = rtrim(config('app.url'), '/');
 $isEvent = isset($project);
 $loc     = app()->getLocale();
 $altUrls = $alt ?? ['en' => '/', 'id' => '/id'];

 if ($isEvent) {
     $pageTitle = $project->tr('title').' | '.$seo['name'];
     $pageDesc  = \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($project->tr('summary') ?: (string) $project->tr('content')))), 155, '');
     $pagePath  = $altUrls[$loc];
     $pageImage = $base.parse_url($project->cover_url, PHP_URL_PATH);
 } else {
     $pageTitle = $seo['home_title'];
     $pageDesc  = $seo['description'];
     $pagePath  = $altUrls[$loc];
     $pageImage = $base.'/'.ltrim($seo['og_image'], '/');
 }
 $pageUrl = $base.$pagePath;

 $org = [
     '@type'       => 'ProfessionalService',
     '@id'         => $base.'/#organization',
     'name'        => $seo['name'],
     'legalName'   => $seo['legal_name'],
     'url'         => $base.($loc === 'id' ? '/id' : '/'),
     'logo'        => $base.'/'.ltrim($seo['logo'], '/'),
     'image'       => $base.'/'.ltrim($seo['og_image'], '/'),
     'description' => $seo['description'],
     'telephone'   => $seo['phone'],
     'email'       => $seo['email'],
     'address'     => [
         '@type'           => 'PostalAddress',
         'streetAddress'   => $seo['address']['street'],
         'addressLocality' => $seo['address']['locality'],
         'addressRegion'   => $seo['address']['region'],
         'postalCode'      => $seo['address']['postal'],
         'addressCountry'  => $seo['address']['country'],
     ],
     'areaServed'  => ['@type' => 'Country', 'name' => 'Indonesia'],
     'sameAs'      => $seo['same_as'],
     'hasOfferCatalog' => [
         '@type' => 'OfferCatalog',
         'name'  => 'Event services',
         'itemListElement' => collect($seo['services'])->map(fn ($n) => ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => $n]])->all(),
     ],
 ];

 $graph = [$org];
 if (! $isEvent) {
     $graph[] = ['@type' => 'WebSite', '@id' => $base.'/#website', 'url' => $base.($loc === 'id' ? '/id' : '/'), 'name' => $seo['name'], 'inLanguage' => $loc, 'publisher' => ['@id' => $base.'/#organization']];
 } else {
     $serviceName = collect(config('whatwedo.services', []))->firstWhere('slug', $project->service)['tab'] ?? 'Events';
     $graph[] = [
         '@type' => 'BreadcrumbList',
         'itemListElement' => [
             ['@type' => 'ListItem', 'position' => 1, 'name' => __('site.home'), 'item' => $base.($loc === 'id' ? '/id' : '/')],
             ['@type' => 'ListItem', 'position' => 2, 'name' => $serviceName, 'item' => $base.($loc === 'id' ? '/id' : '/').'#services'],
             ['@type' => 'ListItem', 'position' => 3, 'name' => $project->tr('title'), 'item' => $pageUrl],
         ],
     ];
     $graph[] = [
         '@type' => 'WebPage', '@id' => $pageUrl.'#webpage', 'url' => $pageUrl, 'inLanguage' => $loc, 'name' => $project->tr('title'),
         'description' => $pageDesc, 'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => $pageImage],
         'isPartOf' => ['@id' => $base.'/#website'], 'about' => ['@id' => $base.'/#organization'],
         'dateModified' => $project->updated_at?->toAtomString(),
     ];
 }
 $ld = json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
@endphp
<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $pageDesc }}">
<link rel="canonical" href="{{ $pageUrl }}">
<link rel="alternate" hreflang="en" href="{{ $base.$altUrls['en'] }}">
<link rel="alternate" hreflang="id" href="{{ $base.$altUrls['id'] }}">
<link rel="alternate" hreflang="x-default" href="{{ $base.$altUrls['en'] }}">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">
<meta name="theme-color" content="#ffffff">
<link rel="icon" href="/favicon.ico" sizes="48x48">
<link rel="icon" type="image/png" href="/favicon-192.png" sizes="192x192">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<meta property="og:type" content="{{ $isEvent ? 'article' : 'website' }}">
<meta property="og:site_name" content="{{ $seo['name'] }}">
<meta property="og:locale" content="{{ $loc === 'id' ? 'id_ID' : 'en_US' }}">
<meta property="og:locale:alternate" content="{{ $loc === 'id' ? 'en_US' : 'id_ID' }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDesc }}">
<meta property="og:url" content="{{ $pageUrl }}">
<meta property="og:image" content="{{ $pageImage }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $pageDesc }}">
<meta name="twitter:image" content="{{ $pageImage }}">
@if($isEvent)
<link rel="preload" as="image" href="{{ $project->cover_url }}" fetchpriority="high">
@elseif(isset($c['hero']['photo']))
<link rel="preload" as="image" href="{{ asset('images/'.$c['hero']['photo'].'.jpg') }}" fetchpriority="high">
@endif
<script type="application/ld+json">{!! $ld !!}</script>
