<?php

namespace App\Http\Controllers;

use App\Models\Project;

class PageController extends Controller
{
    public function home()
    {
        return $this->renderHome('en');
    }

    public function homeId()
    {
        return $this->renderHome('id');
    }

    public function show(Project $project)
    {
        return $this->renderEvent($project, 'en');
    }

    public function showId(Project $project)
    {
        return $this->renderEvent($project, 'id');
    }

    private function renderHome(string $loc)
    {
        $this->bootLocale($loc, ['en' => route('home', [], false), 'id' => route('home.id', [], false)]);

        $projects = Project::published()->orderBy('sort_order')->orderBy('id')->get()->groupBy('service');

        return view('home', ['c' => config('company'), 'projects' => $projects]);
    }

    private function renderEvent(Project $project, string $loc)
    {
        abort_unless($project->is_published, 404);

        $this->bootLocale($loc, [
            'en' => route('events.show', $project, false),
            'id' => route('events.show.id', $project, false),
        ]);

        $service = collect(config('whatwedo.services', []))->firstWhere('slug', $project->service);

        $related = Project::published()
            ->where('service', $project->service)
            ->where('id', '!=', $project->id)
            ->orderBy('sort_order')->orderBy('id')
            ->take(3)->get();

        return view('events.show', [
            'c' => config('company'),
            'project' => $project,
            'service' => $service,
            'related' => $related,
        ]);
    }

    /** Set bahasa aktif, gabungkan teks Indonesia ke config, dan bagikan variabel ke semua view. */
    private function bootLocale(string $loc, array $alt): void
    {
        app()->setLocale($loc);

        if ($loc === 'id') {
            foreach (['company', 'whatwedo', 'team_quote', 'seo'] as $key) {
                config([$key => array_replace_recursive(config($key, []), config($key.'_id', []))]);
            }
        }

        view()->share([
            'lang' => $loc,
            'alt' => $alt,
            'homeUrl' => $loc === 'id' ? route('home.id', [], false) : route('home', [], false),
        ]);
    }
}
