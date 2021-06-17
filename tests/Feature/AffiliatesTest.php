<?php

namespace Tests\Feature;

use Tests\TestCase;

class AffiliatesTest extends TestCase
{
    /** @test */
    public function a_user_will_see_the_home_page()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSee('something');
    }
}
