<?php

namespace Tests\Feature;

use App\User;
use function foo\func;
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

        $this->get(route('users.index'))
            ->assertStatus(200)
            ->assertSee('Users list')
            ->assertSee('Maria')
            ->assertSee('Ana');
    }

    /** @test */
    function itLoadsTheEmptyUsersListPage()
    {
        $this->get(route('users.index'))
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

        $this->get(route('users.show', $user->id))
            ->assertStatus(200)
            ->assertSee($user->name);
    }

    /** @test */
    function itDisplays404ErrorIfUserIsNotFound()
    {
        $this->get(route('users.show', 999))
            ->assertStatus(404)
            ->assertSee('User not found');
    }

    /** @test */
    function itLoadsTheNewUserPage()
    {
        $this->get(route('users.create'))
            ->assertStatus(200)
            ->assertSee('Create new user');
    }

    /** @test */
    function itCreatesANewUser()
    {
        $this->post(route('users.store'), [
            'name' => 'Angel',
            'email' => 'angel@example.com',
            'password' => '123456',
        ])->assertRedirect(route('users.index'));

        $this->assertCredentials([
            'name' => 'Angel',
            'email' => 'angel@example.com',
            'password' => '123456'
        ]);
    }

    /** @test */
    function theNameIsRequired()
    {
        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => '',
            'email' => 'noname@example.com',
            'password' => '123456',
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors([
                'name' => 'The name field is required'
            ]);

        $this->assertDatabaseMissing('users', [
            'email' => 'noname@example.com',
        ]);
    }

    /** @test */
    function theEmailIsRequired()
    {
        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => 'Andrea',
            'email' => '',
            'password' => '123456',
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors([
                'email' => 'The email field is required.'
            ]);

        $this->assertDatabaseMissing('users', [
            'name' => 'Andrea',
        ]);
    }

    /** @test */
    function theEmailIsUnique()
    {
        factory(User::class)->create([
            'name' => 'Jesus',
            'email' => 'jesus@example.com'
        ]);

        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => 'Jesus',
            'email' => 'jesus@example.com',
            'password' => '123456',
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors([
                'email' => 'The email has already been taken.'
            ]);

        $this->assertEquals(1, User::count());
    }

    /** @test */
    function theEmailIsValid()
    {
        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => 'Jesus',
            'email' => 'jesus',
            'password' => '123456',
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['email']);
    }

    /** @test */
    function thePasswordIsRequired()
    {
        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => 'Andrea',
            'email' => 'andrea@example.com',
            'password' => '',
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors([
                'password' => 'The password field is required.'
            ]);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function thePasswordIsGreaterThan6Chars()
    {
        $this->from(route('users.create'))->post(route('users.store'), [
            'name' => 'Andrea',
            'email' => 'andrea@example.com',
            'password' => '12345',
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors([
                'password' => 'The password must be at least 6 characters.'
            ]);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function itLoadsTheEditUserPage()
    {
        $user = factory(User::class)->create();

        $this->get(route('users.edit', $user->id))
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('Edit user')
            ->assertViewHas('user', function ($viewuser) use ($user) {
                return $viewuser->id === $user->id;
            });
    }

    /** @test */
    function itUpdatesAUser()
    {
        $user = factory(User::class)->create();
        $this->withExceptionHandling();

        $this->put(route('users.show', $user->id), [
            'name' => 'User updated!',
            'email' => 'user_updated@example.com',
            'password' => '123456',
        ])->assertRedirect(route('users.show', $user));

        $this->assertCredentials([
            'name' => 'User updated!',
            'email' => 'user_updated@example.com',
            'password' => '123456',
        ]);
    }

    /** @test */
    function theNameIsRequiredWhenUpdatingTheUser()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $this->from(route('users.edit', $user->id))
            ->put(route('users.show', $user->id), [
                'name' => '',
                'email' => 'ana@example.com',
                'password' => '123456',
            ])->assertRedirect(route('users.edit', $user))
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', [
            'email' => 'ana@example.com'
        ]);
    }

    /** @test */
    function theEmailIsRequiredWhenUpdatingTheUser()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $this->from(route('users.edit', $user->id))
            ->put(route('users.show', $user->id), [
                'name' => 'Susana',
                'email' => '',
                'password' => '123456',
            ])->assertRedirect(route('users.edit', $user))
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', [
            'name' => 'Susana'
        ]);
    }

    /** @test */
    function theEmailIsUniqueWhenUpdatingTheUser()
    {
        $randomUser = factory(User::class)->create();

        factory(User::class)->create([
            'name' => 'Jesus',
            'email' => 'jesus@example.com'
        ]);

        $this->from(route('users.edit', $randomUser->id))
            ->put(route('users.update', $randomUser->id), [
                'email' => 'jesus@example.com',
            ])->assertRedirect(route('users.edit', $randomUser))
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(2, User::count());
    }

    /** @test */
    function theEmailIsValidWhenUpdatingTheUser()
    {
        $user = factory(User::class)->create();

        $this->from(route('users.edit', $user->id))
            ->put(route('users.show', $user->id), [
                'name' => 'notValidEmail',
                'email' => 'not-valid-email',
                'password' => '12345',
            ])->assertRedirect(route('users.edit', $user))
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', [
            'name' => 'notValidEmail'
        ]);
    }

    /** @test */
    function theEmailCanStayTheSameWhenUpdatingTheUser()
    {
        $user = factory(User::class)->create([
            'email' => 'marta@example.com',
        ]);

        $this->from(route('users.edit', $user->id))
            ->put(route('users.show', $user->id), [
                'name' => 'Marta',
                'email' => 'marta@example.com',
                'password' => '123456',
            ])->assertRedirect(route('users.show', $user));

        $this->assertDatabaseHas('users', [
            'name' => 'Marta',
            'email' => 'marta@example.com',
        ]);
    }

    /** @test */
    function thePasswordIsOptionalWhenUpdatingTheUser()
    {
        $oldPassword = 'old_pass';

        $user = factory(User::class)->create([
            'password' => bcrypt($oldPassword),
        ]);

        $this->from(route('users.edit', $user->id))
            ->put(route('users.show', $user->id), [
                'name' => 'Jesus',
                'email' => 'jesus@example.com',
                'password' => '',
            ])->assertRedirect(route('users.show', $user));

        $this->assertCredentials([
            'name' => 'Jesus',
            'email' => 'jesus@example.com',
            'password' => $oldPassword,
        ]);
    }

    /** @test */
    function itDetelesAUser()
    {
        $user = factory(User::class)->create();

        $this->delete(route('users.destroy', $user))
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

}
