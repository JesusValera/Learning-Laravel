<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{

    function testItLoadsTheUsersListPage()
    {
        $this->get('/users')
            ->assertStatus(200)
            ->assertSee('Users list')
            ->assertSee('Jesus')
            ->assertSee('Juan')
            ->assertSee('Jose');
    }

    /** @test  */
    function itLoadsTheEmptyUsersListPage()
    {
        $this->get('/users?empty')
            ->assertStatus(200)
            ->assertSee('Users list')
            ->assertSee('No users found');
    }

    /** @test */
    function itLoadsTheUserDetailPage()
    {
        $this->get('/users/5')
            ->assertStatus(200)
            ->assertSee('details of user with id 5');
    }

    /** @test */
    function itEditTheUser()
    {
        $this->get('/users/5/edit')
            ->assertStatus(200)
        ->assertSee('Editing the user with id 5');
    }

    /** @test */
    function itDoesntEditTheUser()
    {
        $this->get('/users/Jesus/edit')
            ->assertStatus(200)
        ->assertSee('Hello Jesus whose nickname is edit');
    }

    /** @test */
    function itLoadsTheNewUserPage()
    {
        //$this->withoutExceptionHandling();

        $this->get('/users/new')
            ->assertStatus(200)
            ->assertSee('Creating new user');
    }

}
