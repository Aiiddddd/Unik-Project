<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoutesTest extends TestCase
{
    public function test_application_boots_and_home_route_works(): void
    {
        $this->get('/')->assertOk();
    }
}
