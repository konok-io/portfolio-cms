<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageTest extends TestCase
{
    public function test_homepage_loads_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_admin_login_page_loads_successfully(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
    }
}
