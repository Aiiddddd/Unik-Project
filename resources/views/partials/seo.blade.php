@php
 $seo     = config('seo');
 $base    = rtrim(config('app.url'), '/');
 $isEvent = isset($project);

 if ($isEvent) {
     $pageTitle = $project->title.' | '.$seo['name'];
     $pageDesc  = \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($project->summary ?: (string) $project->content))), 155, '');
     $pagePath  = route('events.show', $project, false);
     $pageImage = $base.parse_url($project->cover_url, PHP_URL_PATH);
 } else {
     $pageTitle = $seo['home_title'];
     $pageDesc  = $seo['description'];
     $pagePath  = '/';
     $pageImage = $base.'/'.ltrim($seo['og_image'], '/');
 }
 $pageUrl = $base.$pagePath;

 $org = [
     '@type'       => 'ProfessionalService',
     '@id'         => $base.'/#organization',
     'name'        => $seo['name'],
     'legalName'   => $seo['legal_name'],
     'url'         => $base.'/',
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
     $graph[] = ['@type' => 'WebSite', '@id' => $base.'/#website', 'url' => $base.'/', 'name' => $seo['name'], 'inLanguage' => 'en', 'publisher' => ['@id' => $base.'/#organization']];
 } else {
     $serviceName = collect(config('whatwedo.services', []))->firstWhere('slug', $project->service)['tab'] ?? 'Events';
     $graph[] = [
         '@type' => 'BreadcrumbList',
         'itemListElement' => [
             ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $base.'/'],
             ['@type' => 'ListItem', 'position' => 2, 'name' => $serviceName, 'item' => $base.'/#services'],
             ['@type' => 'ListItem', 'position' => 3, 'name' => $project->title, 'item' => $pageUrl],
         ],
     ];
     $graph[] = [
         '@type' => 'WebPage', '@id' => $pageUrl.'#webpage', 'url' => $pageUrl, 'name' => $project->title,
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
<meta name="robots" content="{{ config('site.indexable') ? 'index, follow, max-image-preview:large, max-snippet:-1' : 'noindex, nofollow' }}">
<meta name="theme-color" content="#ffffff">
<link rel="icon" href="/favicon.ico" sizes="48x48">
<link rel="icon" type="image/png" href="/favicon-192.png" sizes="192x192">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<meta property="og:type" content="{{ $isEvent ? 'article' : 'website' }}">
<meta property="og:site_name" content="{{ $seo['name'] }}">
<meta property="og:locale" content="{{ $seo['locale'] }}">
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
