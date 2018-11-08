<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    use RefreshDatabase;

    function testItLoadsTheUsersListPage()
    {
        factory(User::class)->create([
            'name' => 'Maria',
            'website' => 'http://mariawebsite.com/',
        ]);
        factory(User::class)->create([
            'name' => 'Ana',
        ]);

        $this->get('/users')
            ->assertStatus(200)
            ->assertSee('Users list')
            ->assertSee('Maria')
            ->assertSee('Ana');
    }

    /** @test  */
    function itLoadsTheEmptyUsersListPage()
    {
        $this->get('/users')
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
