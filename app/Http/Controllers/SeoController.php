<?php

namespace App\Http\Controllers;

use App\Models\Project;

class SeoController extends Controller
{
    public function sitemap()
    {
        $base = rtrim(config('app.url'), '/');
        $projects = Project::published()->orderBy('sort_order')->orderBy('id')->get();
        $latest = ($projects->max('updated_at') ?? now())->toAtomString();

        $pages = [['en' => '/', 'id' => '/id', 'lastmod' => $latest, 'priority' => '1.0']];
        foreach ($projects as $p) {
            $pages[] = [
                'en' => route('events.show', $p, false),
                'id' => route('events.show.id', $p, false),
                'lastmod' => $p->updated_at->toAtomString(),
                'priority' => '0.7',
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n"
             .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">'."\n";

        foreach ($pages as $pg) {
            $en = e($base.$pg['en']);
            $id = e($base.$pg['id']);
            $alts = '<xhtml:link rel="alternate" hreflang="en" href="'.$en.'"/>'
                  .'<xhtml:link rel="alternate" hreflang="id" href="'.$id.'"/>'
                  .'<xhtml:link rel="alternate" hreflang="x-default" href="'.$en.'"/>';
            foreach ([$en, $id] as $loc) {
                $xml .= '  <url><loc>'.$loc.'</loc><lastmod>'.$pg['lastmod'].'</lastmod><priority>'.$pg['priority'].'</priority>'.$alts.'</url>'."\n";
            }
        }
        $xml .= '</urlset>'."\n";

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function robots()
    {
        $base = rtrim(config('app.url'), '/');
        $txt = "User-agent: *\nDisallow: /admin\nDisallow: /livewire\nAllow: /\n\nSitemap: {$base}/sitemap.xml\n";

        return response($txt, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }
}
