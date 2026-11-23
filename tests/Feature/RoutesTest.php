<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_application_boots_and_home_route_works(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_home_footer_displays_instagram_and_developer_credit(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('class="site-footer"', false)
            ->assertSee('Company')
            ->assertSee('Services')
            ->assertSee('Follow Us')
            ->assertSee('href="https://www.instagram.com/unikeventsolution/"', false)
            ->assertSee('href="https://centrova.id"', false)
            ->assertSee('Website by')
            ->assertSee('Centrova.id');
    }
}
