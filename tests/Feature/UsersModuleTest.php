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

    /** @test */
    function itLoadsTheEmptyUsersListPage()
    {
        $this->get('/users')
            ->assertStatus(200)
            ->assertSee('Users list')
            ->assertSee('No users found');
    }

    /** @test */
    function itDisplaysTheUserDetailsPage()
    {
        $user = factory(User::class)->create([
            'name' => 'Jesus',
        ]);

        $this->get('/users/' . $user->id)
            ->assertStatus(200)
            ->assertSee($user->name);
    }

    /** @test */
    function itDisplays404ErrorIfUserIsNotFound()
    {
        $this->get('/users/999')
            ->assertStatus(404)
            ->assertSee('User not found');
    }

    /** @test */
    function itEditsTheUser()
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

        $this->get('/users/create')
            ->assertStatus(200)
            ->assertSee('Creating new user');
    }

    /** @test */
    function itCreatesANewUser()
    {
        $this->post('/users/store', [
            'name' => 'Angel',
            'email' => 'angel@example.com',
            'password' => '123456',
        ])->assertRedirect(route('user_index'));

        $this->assertCredentials([
            'name' => 'Angel',
            'email' => 'angel@example.com',
            'password' => '123456'
        ]);
    }

    /** @test */
    function theNameIsRequired()
    {
        $this->from('/users/create')->post('/users/store', [
            'name' => '',
            'email' => 'noname@example.com',
            'password' => '123456',
        ])->assertRedirect(route('user_create'))
            ->assertSessionHasErrors([
                'name' => 'The name field is required'
            ]);

        //$this->assertEquals(0, User::count());
        $this->assertDatabaseMissing('users', [
            'email' => 'noname@example.com',
        ]);
    }

}
