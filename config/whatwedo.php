<?php

// Konten section "What we do". Daftar event/project sekarang dikelola dari admin panel (/admin).
return [
    'head' => [
        'eyebrow' => 'What we do',
        'title' => 'Turning Ideas into Meaningful Experiences',
        'text' => 'We deliver well-crafted events that inspire, connect, and create lasting impact for your audience and brand.',
        'side' => 'From concept to execution, we bring your vision to life through creative planning, seamless coordination, and memorable experiences.',
        'points' => [['calendar', 'Creative Planning'], ['users', 'Professional Execution'], ['star', 'Lasting Impact']],
        'cta' => ['lines' => ['Every event', 'is a new story.'], 'text' => "Let's create yours together.", 'button' => 'Contact us', 'photo' => 'belief'],
    ],

    // slug harus sama dengan nilai "service" di tabel projects
    'services' => [
        [
            'slug' => 'event-management',
            'tab' => 'Event Management',
            'heading' => 'Creating Impactful Events',
            'text' => 'We turn creative solutions into exciting experiences for your audience and deliver the right brand communication.',
        ],
        [
            'slug' => 'meeting-planning',
            'tab' => 'Meeting Planning',
            'heading' => 'Meetings That Run Seamlessly',
            'text' => 'Tailor-made meeting and congress management with expert planning, innovative technology, and well-managed reports and budgets.',
        ],
        [
            'slug' => 'creative-development',
            'tab' => 'Creative Development',
            'heading' => 'Designing Spaces That Speak for Your Brand',
            'text' => "We design environments and supporting ideas that deepen the audience's experience of your brand and strengthen its image.",
        ],
        [
            'slug' => 'digital-multimedia',
            'tab' => 'Digital & Multimedia',
            'heading' => 'Stories Made for Every Screen',
            'text' => 'Interactive media across design, motion graphics, streaming, video and sound editing, and prototyping, delivered by an experienced team.',
        ],
    ],
];
