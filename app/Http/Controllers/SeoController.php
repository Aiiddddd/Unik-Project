<?php

namespace App\Http\Controllers;

use App\Models\Project;

class SeoController extends Controller
{
    public function sitemap()
    {
        $base = rtrim(config('app.url'), '/');
        $projects = Project::published()->orderBy('sort_order')->orderBy('id')->get();

        $latest = $projects->max('updated_at');
        $urls = [[
            'loc'      => $base.'/',
            'lastmod'  => ($latest ?? now())->toAtomString(),
            'priority' => '1.0',
        ]];

        foreach ($projects as $p) {
            $urls[] = [
                'loc'      => $base.route('events.show', $p, false),
                'lastmod'  => $p->updated_at->toAtomString(),
                'priority' => '0.7',
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
        foreach ($urls as $u) {
            $xml .= '  <url><loc>'.e($u['loc']).'</loc><lastmod>'.$u['lastmod'].'</lastmod><priority>'.$u['priority'].'</priority></url>'."\n";
        }
        $xml .= '</urlset>'."\n";

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function robots()
    {
        $base = rtrim(config('app.url'), '/');
        $txt  = config('site.indexable')
            ? "User-agent: *\nDisallow: /admin\nDisallow: /livewire\nAllow: /\n\nSitemap: {$base}/sitemap.xml\n"
            : "User-agent: *\nDisallow: /\n";

        return response($txt, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }
}
