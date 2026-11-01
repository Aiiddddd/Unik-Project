<?php

// Semua konten website ada di sini. Foto ada di public/images (tulis nama file tanpa .jpg).
return [
    'name' => 'UNIK Event Solutions',
    'legal' => 'PT Kinarya Abimantrana Sentosa',

    'hero' => [
        'title' => ['Events that leave a', 'positive impact.'], // satu item = satu baris
        'text' => 'We bring ideas to life through impactful events and meaningful experiences, from conventions and trade shows to government missions and virtual events.',
        'photo' => 'about2',
        'photo_alt' => 'Traditional dance performance on a lit stage in a ballroom',
    ],

    'about' => 'UNIK is a Jakarta-based professional convention and event management company. We handle every part of planning and managing physical and virtual events, exhibitions, audio-visual production, government-sponsored promotion missions, and trade shows.',
    'belief' => 'We believe great work comes from a conscious act to bring a positive impact. With this always in mind, we strive for excellence that brings mutual satisfaction to every individual involved.',

    'why' => [
        'title' => 'Why Choose Us ?',
        'text' => 'Our strength lies in the combination of creative thinking and disciplined execution, from the first idea to the last cue.',
        'items' => [
            ['landmark', 'Trusted by national institutions', 'We have delivered events for government ministries, national agencies, and international gatherings, including the Interpol General Assembly in Bali and World Press Freedom Day. Protocol, scheduling, and stage production are handled with the precision these occasions demand.'],
            ['layers', 'Complete services under one roof', 'Event management, meeting planning, creative development, and digital and multimedia production are handled by one team. You work with a single partner from concept and design to staging, broadcast, and final handover.'],
            ['video', 'Live, virtual, and hybrid events', 'We run physical events, webinars, and live-streamed programs with equal confidence. From a national planning meeting held in a virtual format to book launches streamed online, we handle the studio, the stream, and the on-screen experience.'],
            ['palette', 'Creative design that strengthens your brand', 'From the Bisma stage for BEKRAF to exhibition booths for Dräger and BPJS Ketenagakerjaan, our creative team designs environments and materials that reflect your brand and deepen the audience\'s experience of it.'],
            ['chart', 'Clear reports and well-managed budgets', 'Budgets are planned carefully and progress is reported transparently, so you always know where your event stands. Optimized reporting and cost control are built into every project from the start, not added at the end.'],
            ['users', 'A dedicated, multi-skilled team', 'Producers, creative planners, account executives, and finance specialists work side by side. Each event is tailor-made around your goals and your audience, and what unites our team is a shared penchant for great work.'],
        ],
    ],

    'team_text' => 'A million different interests, life stories, and skills, with one thing in common: a penchant for great work.',
    'team' => [
        ['Nonny Jelita', 'CEO', 'nonny'],
        ['Gracia Wuwungan', 'Managing Director', 'gracia'],
        ['Baby Zelvia', 'Account Director', 'baby'],
        ['Maruli Hutabarat', 'Production', 'maruli'],
        ['Natasha Ririmasse', 'Creative', 'natasha'],
        ['Felicya', 'Finance', 'felicya'],
        ['Kiky', 'Account Executive', 'kiki'],
    ],

    // projects: [judul, deskripsi, foto]  -- foto ada di public/images (tanpa .jpg)
    'services' => [
        [
            'tab' => 'Event Management', 'title' => 'Event Management',
            'text' => 'We turn creative solutions into exciting experiences for the audience and deliver the right brand communication.',
            'bullets' => ['Launches, ceremonies, and gala events', 'Exhibition and trade show booths', 'Community and corporate events'],
            'projects' => [
                ['Interpol General Assembly Bali 2016', 'International assembly with opening ceremony and stage production', 'em-interpol'],
                ['Workshop Humas Polri 2020', 'National police public relations workshop', 'em-polri'],
                ['Catatan Merah dari Putera Bung Karno 2021', 'Book launch with a virtual talk show studio', 'em-virtual'],
                ['Ducati and BPJS Ketenagakerjaan booths', 'Exhibition booth management', 'em-ducati'],
                ['Astra Runners', 'Community running event', 'em-astra'],
            ],
        ],
        [
            'tab' => 'Meeting Planning', 'title' => 'Meeting Planning',
            'text' => 'Tailor-made meeting and congress management with expert planning, innovative technology, and well-managed reports and budgets, for a seamless experience.',
            'bullets' => ['Forums, summits, and conventions', 'Hybrid and virtual meetings', 'Reporting and budget control'],
            'projects' => [
                ['World Press Freedom Day 2017', 'International conference', 'mp-wpfd'],
                ['Indonesia Development Forum 2018', 'National development forum', 'mp-idf'],
                ['Indonesia Human Capital Summit 2017', 'Summit and panel sessions', 'mp-hcs'],
                ['42nd IPA Convention & Exhibition 2018', 'Jakarta Convention Center, 2-4 May 2018', 'mp-ipa'],
                ['Musrenbangnas 2021', 'Virtual national planning meeting for Kementerian PPN/Bappenas', 'mp-musren'],
            ],
        ],
        [
            'tab' => 'Creative Development', 'title' => 'Creative Development',
            'text' => 'We design environments and supporting ideas that deepen the audience\'s experience of your brand and strengthen its image.',
            'bullets' => ['Booth and stage design', 'Event branding and print collateral', '3D visualisation'],
            'projects' => [
                ['Bisma stage design 2018', 'Stage and environment design for BEKRAF', 'cd-bisma'],
                ['Dräger exhibition booth', 'Booth design and 3D visualisation', 'cd-drager'],
                ['BPJS Ketenagakerjaan booth', 'Booth design with photo wall', 'cd-bpjs'],
                ['Forcepoint office branding', 'Environmental branding for Netpoleon', 'cd-forcepoint'],
            ],
        ],
        [
            'tab' => 'Digital & Multimedia', 'title' => 'Digital & Multimedia Concept',
            'text' => 'Interactive media production across design, motion graphics, web coding, streaming, video and sound editing, and prototyping, delivered by an experienced team.',
            'bullets' => ['Webinars and live streaming', 'Mapping projection and interactive LED', 'Motion graphics and digital invitations'],
            'projects' => [
                ['Bisma Goes to Get Member 2018', 'Interactive LED wall and digital invitation for BEKRAF', 'dm-mapping'],
                ['IAPH Bali and FILARTC 2017', 'Mapping projection and event visuals', 'dm-iaph'],
                ['Bung Karno book launch webinar 2021', 'Webinar visuals and live streaming', 'dm-poster2'],
            ],
        ],
    ],

    // [nama, file (di public/images/clients), lebar, tinggi]
    'clients' => [
        ['BEKRAF', 'bekraf', 616, 606],
        ['Guntur Soekarno', 'guntur-soekarno', 361, 32],
        ['Kementerian PPN/Bappenas', 'bappenas', 405, 119],
        ['Ducati', 'ducati', 530, 482],
        ['BPJS Ketenagakerjaan', 'bpjs-ketenagakerjaan', 383, 99],
        ['Divisi Humas Mabes Polri', 'divisi-humas-polri', 365, 27],
        ['MNC Securities', 'mnc-securities', 406, 149],
        ['Netpoleon', 'netpoleon', 369, 64],
        ['Dräger', 'drager', 371, 143],
        ['Bumi Daya Plaza', 'bumi-daya-plaza', 678, 260],
    ],
    'collaborators' => [
        ['Dyandra Convex', 'dyandra-convex', 404, 37],
        ['Indonesia Smart City Forum', 'iscf', 400, 92],
        ['Lenox', 'lenox', 380, 92],
        ['Indonesian Film Directors Club', 'ifdc', 318, 130],
    ],

    'contact' => [
        'address' => ['Jl. TB. Simatupang, Harka Offices', 'Alamanda Tower Lt. 2 Unit H1 No. 23-24', 'Cilandak Barat, Jakarta Selatan 12430'],
        'phone' => '021 22760303',
        'mobile' => '081215872907',
        'whatsapp' => '6281288662235',
        'email' => 'unikeventsolutions@gmail.com',
        'instagram' => 'unikeventsolution',
        'website' => 'www.unikeventsolution.com',
    ],
];
