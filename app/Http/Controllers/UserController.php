<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $title = 'Users list';

        return view('users.index', compact('users', 'title'));
    }

    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user,
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'The name field is required',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => '',
        ]);

        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);

        return redirect()->route('users.show', [
            'user' => $user
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
