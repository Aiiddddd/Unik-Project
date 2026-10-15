<?php

// Konten section "What we do". Foto ada di public/images (tulis nama file tanpa .jpg).
// projects: [judul, deskripsi singkat, foto, kategori]
return [
    'head' => [
        'eyebrow' => 'What we do',
        'title'   => 'Turning Ideas into Meaningful Experiences',
        'text'    => 'We deliver well-crafted events that inspire, connect, and create lasting impact for your audience and brand.',
        'side'    => 'From concept to execution, we bring your vision to life through creative planning, seamless coordination, and unforgettable experiences.',
        'points'  => [['calendar', 'Creative Planning'], ['users', 'Professional Execution'], ['star', 'Lasting Impact']],
        'cta'     => ['lines' => ['Every event', 'is a new story.'], 'text' => "Let's create yours together.", 'button' => 'Contact us', 'photo' => 'belief'],
    ],

    'services' => [
        [
            'tab'     => 'Event Management',
            'heading' => 'Creating Impactful Events',
            'text'    => 'We turn creative solutions into exciting experiences for your audience and deliver the right brand communication.',
            'projects' => [
                ['Interpol General Assembly Bali 2016', 'International assembly with opening ceremony and stage production.', 'em-interpol', 'Government & Institution'],
                ['Workshop Humas Polri 2020', 'National police public relations workshop.', 'em-polri', 'Conference & Seminar'],
                ['Catatan Merah dari Putera Bung Karno 2021', 'Book launch with a virtual talk show studio.', 'em-virtual', 'Virtual & Hybrid'],
                ['Ducati and BPJS Ketenagakerjaan Booths', 'Brand activation and exhibition booth setup.', 'em-ducati', 'Exhibition & Trade Show'],
                ['Astra Runners', 'Community running event.', 'em-astra', 'Community & Corporate'],
            ],
        ],
        [
            'tab'     => 'Meeting Planning',
            'heading' => 'Meetings That Run Seamlessly',
            'text'    => 'Tailor-made meeting and congress management with expert planning, innovative technology, and well-managed reports and budgets.',
            'projects' => [
                ['World Press Freedom Day 2017', 'International conference on media and press freedom.', 'mp-wpfd', 'International Conference'],
                ['Indonesia Development Forum 2018', 'National development forum with panel sessions.', 'mp-idf', 'Government & Institution'],
                ['Indonesia Human Capital Summit 2017', 'Summit with keynote and panel sessions.', 'mp-hcs', 'Summit & Forum'],
                ['42nd IPA Convention & Exhibition 2018', 'Jakarta Convention Center, 2-4 May 2018.', 'mp-ipa', 'Convention & Exhibition'],
                ['Musrenbangnas 2021', 'Virtual national planning meeting for Kementerian PPN/Bappenas.', 'mp-musren', 'Virtual & Hybrid'],
            ],
        ],
        [
            'tab'     => 'Creative Development',
            'heading' => 'Designing Spaces That Speak for Your Brand',
            'text'    => "We design environments and supporting ideas that deepen the audience's experience of your brand and strengthen its image.",
            'projects' => [
                ['Bisma Stage Design 2018', 'Stage and environment design for BEKRAF.', 'cd-bisma', 'Stage Design'],
                ['Dräger Exhibition Booth', 'Booth design and 3D visualisation.', 'cd-drager', 'Exhibition Design'],
                ['BPJS Ketenagakerjaan Booth', 'Booth design with photo wall.', 'cd-bpjs', 'Exhibition Design'],
                ['Forcepoint Office Branding', 'Environmental branding for Netpoleon.', 'cd-forcepoint', 'Environmental Branding'],
            ],
        ],
        [
            'tab'     => 'Digital & Multimedia',
            'heading' => 'Stories Made for Every Screen',
            'text'    => 'Interactive media across design, motion graphics, streaming, video and sound editing, and prototyping, delivered by an experienced team.',
            'projects' => [
                ['Bisma Goes to Get Member 2018', 'Interactive LED wall and digital invitation for BEKRAF.', 'dm-mapping', 'Interactive Media'],
                ['IAPH Bali and FILARTC 2017', 'Mapping projection and event visuals.', 'dm-iaph', 'Projection Mapping'],
                ['Bung Karno Book Launch Webinar 2021', 'Webinar visuals and live streaming.', 'dm-poster2', 'Webinar & Streaming'],
            ],
        ],
    ],
];
