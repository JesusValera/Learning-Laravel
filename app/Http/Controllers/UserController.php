<?php

namespace App\Http\Controllers;

use App\User;

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

    public function edit(int $id)
    {
        return view('users.edit', [
            'id' => $id,
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
            /*'email' => 'required|email|unique:users',
            'password' => 'required',*/
        ], [
            'name.required' => 'The name field is required',
        ]);
        //dd($data);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return redirect()->route('user_index');
    }
}
