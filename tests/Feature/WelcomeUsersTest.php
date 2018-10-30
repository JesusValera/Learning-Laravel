<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    public function testWelcomeWithNickName()
    {
        $this->get('/users/jesus/SusVa')
            ->assertStatus(200)
            ->assertSee('Hello Jesus whose nickname is SusVa');
    }

    public function testWelcomeWithNoNickName()
    {
        $this->get('/users/jesus')
        ->assertStatus(200)
        ->assertSee('Hello Jesus');
    }
}
