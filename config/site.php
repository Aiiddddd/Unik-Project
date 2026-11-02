<?php

// SITE_INDEXABLE=false  -> mode staging: robots "Disallow: /" dan meta noindex (Google tidak mengindeks)
// SITE_INDEXABLE=true   -> mode go-live
return [
    'indexable' => (bool) env('SITE_INDEXABLE', false),
];
