<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // [service, judul, ringkasan, foto, label, client, periode, lokasi]
        $rows = [
            ['event-management', 'Interpol General Assembly Bali 2016', 'International assembly with opening ceremony and stage production.', 'em-interpol', 'Government & Institution', 'Interpol', '2016', 'Bali'],
            ['event-management', 'Workshop Humas Polri 2020', 'National police public relations workshop.', 'em-polri', 'Conference & Seminar', 'Divisi Humas Mabes Polri', '2020', null],
            ['event-management', 'Catatan Merah dari Putera Bung Karno 2021', 'Book launch with a virtual talk show studio.', 'em-virtual', 'Virtual & Hybrid', 'Guntur Soekarno', '2021', null],
            ['event-management', 'Ducati and BPJS Ketenagakerjaan Booths', 'Brand activation and exhibition booth setup.', 'em-ducati', 'Exhibition & Trade Show', 'Ducati, BPJS Ketenagakerjaan', null, null],
            ['event-management', 'Astra Runners', 'Community running event.', 'em-astra', 'Community & Corporate', 'Astra', null, null],

            ['meeting-planning', 'World Press Freedom Day 2017', 'International conference on media and press freedom.', 'mp-wpfd', 'International Conference', null, '2017', null],
            ['meeting-planning', 'Indonesia Development Forum 2018', 'National development forum with panel sessions.', 'mp-idf', 'Government & Institution', 'Kementerian PPN/Bappenas', '2018', null],
            ['meeting-planning', 'Indonesia Human Capital Summit 2017', 'Summit with keynote and panel sessions.', 'mp-hcs', 'Summit & Forum', null, '2017', null],
            ['meeting-planning', '42nd IPA Convention & Exhibition 2018', 'Jakarta Convention Center, 2-4 May 2018.', 'mp-ipa', 'Convention & Exhibition', 'Dyandra Convex', '2-4 May 2018', 'Jakarta Convention Center'],
            ['meeting-planning', 'Musrenbangnas 2021', 'Virtual national planning meeting for Kementerian PPN/Bappenas.', 'mp-musren', 'Virtual & Hybrid', 'Kementerian PPN/Bappenas', '2021', null],

            ['creative-development', 'Bisma Stage Design 2018', 'Stage and environment design for BEKRAF.', 'cd-bisma', 'Stage Design', 'BEKRAF', '2018', null],
            ['creative-development', 'Dräger Exhibition Booth', 'Booth design and 3D visualisation.', 'cd-drager', 'Exhibition Design', 'Dräger', null, null],
            ['creative-development', 'BPJS Ketenagakerjaan Booth', 'Booth design with photo wall.', 'cd-bpjs', 'Exhibition Design', 'BPJS Ketenagakerjaan', null, null],
            ['creative-development', 'Forcepoint Office Branding', 'Environmental branding for Netpoleon.', 'cd-forcepoint', 'Environmental Branding', 'Netpoleon', null, null],

            ['digital-multimedia', 'Bisma Goes to Get Member 2018', 'Interactive LED wall and digital invitation for BEKRAF.', 'dm-mapping', 'Interactive Media', 'BEKRAF', '2018', null],
            ['digital-multimedia', 'IAPH Bali and FILARTC 2017', 'Mapping projection and event visuals.', 'dm-iaph', 'Projection Mapping', null, '2017', null],
            ['digital-multimedia', 'Bung Karno Book Launch Webinar 2021', 'Webinar visuals and live streaming.', 'dm-poster2', 'Webinar & Streaming', 'Guntur Soekarno', '2021', null],
        ];

        $dir = storage_path('app/public/projects');
        File::ensureDirectoryExists($dir);

        foreach ($rows as $i => [$service, $title, $summary, $photo, $label, $client, $period, $location]) {
            $src = public_path('images/'.$photo.'.jpg');
            $cover = null;
            if (File::exists($src)) {
                File::copy($src, $dir.'/'.$photo.'.jpg');
                $cover = 'projects/'.$photo.'.jpg';
            }

            Project::updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'service' => $service,
                    'category' => $label,
                    'summary' => $summary,
                    'cover' => $cover,
                    'content' => '<p>'.e($summary).'</p>',
                    'client' => $client,
                    'period' => $period,
                    'location' => $location,
                    'is_published' => true,
                    'sort_order' => $i,
                ]
            );
        }
    }
}
