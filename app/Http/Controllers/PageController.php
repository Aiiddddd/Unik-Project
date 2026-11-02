<?php

namespace App\Http\Controllers;

use App\Models\Project;

class PageController extends Controller
{
    public function home()
    {
        $projects = Project::published()->orderBy('sort_order')->orderBy('id')->get()->groupBy('service');

        return view('home', ['c' => config('company'), 'projects' => $projects]);
    }

    public function show(Project $project)
    {
        abort_unless($project->is_published, 404);

        $service = collect(config('whatwedo.services', []))->firstWhere('slug', $project->service);

        $related = Project::published()
            ->where('service', $project->service)
            ->where('id', '!=', $project->id)
            ->orderBy('sort_order')->orderBy('id')
            ->take(3)->get();

        return view('events.show', [
            'c'       => config('company'),
            'project' => $project,
            'service' => $service,
            'related' => $related,
        ]);
    }
}
