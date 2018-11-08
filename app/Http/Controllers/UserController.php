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

    public function show(int $id)
    {
        return view('users.show', [
            'id' => $id,
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
}
