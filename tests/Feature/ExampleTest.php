<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_whatsapp_button_does_not_include_stale_contact_form_script(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('class="wa"', false);
        $response->assertDontSee("document.getElementById('cf')");
        $response->assertDontSee("document.getElementById('wa').onclick");
    }
}
