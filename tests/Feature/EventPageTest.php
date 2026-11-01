<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_event_content_is_rendered_without_an_event_details_card(): void
    {
        $project = Project::create([
            'title' => 'Example event',
            'slug' => 'example-event',
            'service' => 'event-management',
            'summary' => 'This old short description is not event-page content.',
            'content' => '<p>Event details managed in main content.</p>',
            'client' => 'Example client',
            'period' => 'May 2025',
            'location' => 'Bali',
            'is_published' => true,
        ]);

        $this->assertDatabaseHas('projects', ['slug' => 'example-event', 'is_published' => true]);
        $this->assertSame('/events/example-event', route('events.show', $project, false));

        $response = $this->get('http://localhost/events/'.$project->slug);

        $response->assertOk()
            ->assertSee('Event details managed in main content.')
            ->assertSee('class="prose"', false)
            ->assertSeeInOrder([
                '<h1>Example event</h1>',
                '<dl class="ev-meta">',
                '<dt>Client</dt>',
                '<dd>Example client</dd>',
                '<dt>Period</dt>',
                '<dd>May 2025</dd>',
                '<dt>Location</dt>',
                '<dd>Bali</dd>',
            ], false)
            ->assertDontSee('<p>This old short description is not event-page content.</p>', false)
            ->assertDontSee('class="ev-aside"', false);
    }

    public function test_empty_event_content_does_not_render_an_empty_content_card(): void
    {
        $project = Project::create([
            'title' => 'Example event',
            'slug' => 'example-event',
            'service' => 'event-management',
            'content' => '<p></p>',
            'is_published' => true,
        ]);

        $response = $this->get('http://localhost/events/'.$project->slug);

        $response->assertOk()
            ->assertDontSee('class="prose"', false)
            ->assertDontSee('class="ev-aside"', false)
            ->assertDontSee('class="ev-meta"', false);
    }

    public function test_gallery_with_more_than_six_photos_renders_six_photo_carousel_pages(): void
    {
        $project = Project::create([
            'title' => 'Gallery event',
            'slug' => 'gallery-event',
            'service' => 'event-management',
            'gallery' => [
                'gallery/one.jpg',
                'gallery/two.jpg',
                'gallery/three.jpg',
                'gallery/four.jpg',
                'gallery/five.jpg',
                'gallery/six.jpg',
                'gallery/seven.jpg',
            ],
            'is_published' => true,
        ]);

        $response = $this->get('http://localhost/events/'.$project->slug);

        $response->assertOk()
            ->assertSee('class="gal-pager"', false)
            ->assertSee('class="gal-next"', false);

        $this->assertSame(2, substr_count($response->getContent(), 'class="gallery-slide"'));
        $this->assertSame(7, substr_count($response->getContent(), 'class="gl"'));
    }

    public function test_gallery_with_six_photos_fits_on_one_page(): void
    {
        $project = Project::create([
            'title' => 'Six photo event',
            'slug' => 'six-photo-event',
            'service' => 'event-management',
            'gallery' => [
                'gallery/one.jpg',
                'gallery/two.jpg',
                'gallery/three.jpg',
                'gallery/four.jpg',
                'gallery/five.jpg',
                'gallery/six.jpg',
            ],
            'is_published' => true,
        ]);

        $response = $this->get('http://localhost/events/'.$project->slug);

        $response->assertOk()
            ->assertSee('<div class="gal-pager" hidden>', false);

        $this->assertSame(1, substr_count($response->getContent(), 'class="gallery-slide"'));
        $this->assertSame(6, substr_count($response->getContent(), 'class="gl"'));
    }
}
