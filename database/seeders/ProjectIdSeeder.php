<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectIdSeeder extends Seeder
{
    public function run(): void
    {
        // [judul Inggris (untuk mencari slug) => [judul ID, ringkasan ID, label ID]]
        $rows = [
            'Interpol General Assembly Bali 2016' => ['Sidang Umum Interpol Bali 2016', 'Sidang internasional dengan upacara pembukaan dan produksi panggung.', 'Pemerintahan & Institusi'],
            'Workshop Humas Polri 2020' => ['Workshop Humas Polri 2020', 'Lokakarya kehumasan Polri tingkat nasional.', 'Konferensi & Seminar'],
            'Catatan Merah dari Putera Bung Karno 2021' => ['Catatan Merah dari Putera Bung Karno 2021', 'Peluncuran buku dengan studio talk show virtual.', 'Virtual & Hybrid'],
            'Ducati and BPJS Ketenagakerjaan Booths' => ['Booth Ducati dan BPJS Ketenagakerjaan', 'Aktivasi merek dan pengelolaan booth pameran.', 'Pameran & Trade Show'],
            'Astra Runners' => ['Astra Runners', 'Acara lari komunitas.', 'Komunitas & Korporat'],

            'World Press Freedom Day 2017' => ['World Press Freedom Day 2017', 'Konferensi internasional tentang media dan kebebasan pers.', 'Konferensi Internasional'],
            'Indonesia Development Forum 2018' => ['Indonesia Development Forum 2018', 'Forum pembangunan nasional dengan sesi panel.', 'Pemerintahan & Institusi'],
            'Indonesia Human Capital Summit 2017' => ['Indonesia Human Capital Summit 2017', 'Konferensi tingkat tinggi dengan sesi keynote dan panel.', 'Summit & Forum'],
            '42nd IPA Convention & Exhibition 2018' => ['42nd IPA Convention & Exhibition 2018', 'Jakarta Convention Center, 2-4 Mei 2018.', 'Konvensi & Pameran'],
            'Musrenbangnas 2021' => ['Musrenbangnas 2021', 'Musyawarah perencanaan pembangunan nasional secara virtual untuk Kementerian PPN/Bappenas.', 'Virtual & Hybrid'],

            'Bisma Stage Design 2018' => ['Desain Panggung Bisma 2018', 'Desain panggung dan lingkungan acara untuk BEKRAF.', 'Desain Panggung'],
            'Dräger Exhibition Booth' => ['Booth Pameran Dräger', 'Desain booth dan visualisasi 3D.', 'Desain Pameran'],
            'BPJS Ketenagakerjaan Booth' => ['Booth BPJS Ketenagakerjaan', 'Desain booth dengan dinding foto.', 'Desain Pameran'],
            'Forcepoint Office Branding' => ['Branding Kantor Forcepoint', 'Branding lingkungan untuk Netpoleon.', 'Branding Lingkungan'],

            'Bisma Goes to Get Member 2018' => ['Bisma Goes to Get Member 2018', 'Dinding LED interaktif dan undangan digital untuk BEKRAF.', 'Media Interaktif'],
            'IAPH Bali and FILARTC 2017' => ['IAPH Bali dan FILARTC 2017', 'Proyeksi mapping dan visual acara.', 'Projection Mapping'],
            'Bung Karno Book Launch Webinar 2021' => ['Webinar Peluncuran Buku Bung Karno 2021', 'Visual webinar dan siaran langsung.', 'Webinar & Streaming'],
        ];

        foreach ($rows as $en => [$title, $summary, $label]) {
            $p = Project::where('slug', Str::slug($en))->first();
            if (! $p) {
                continue;
            }
            // hanya mengisi yang masih kosong, jadi edit manual dari admin tidak tertimpa
            $p->title_id = $p->title_id ?: $title;
            $p->summary_id = $p->summary_id ?: $summary;
            $p->label_id = $p->label_id ?: $label;
            $p->content_id = $p->content_id ?: '<p>'.e($summary).'</p>';
            $p->save();
        }
    }
}
