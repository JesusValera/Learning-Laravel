<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (request()->has('empty')) {
            $users = [];
        } else {
            $users = [
                'Jesus',
                'Juan',
                'Jose',
                'Pepe',
                '<script>alert("ALERT!!")</script>'
            ];
        }

        return view('users', [
            'users' => $users,
            'title' => 'Users list',
        ]);
    }

    public function show(int $id)
    {
        return view('users_show', [
            'id' => $id,
        ]);
    }

    public function edit(int $id)
    {
        return view('users_edit', [
            'id' => $id,
        ]);
    }

    public function create()
    {
        return view('users_create');
    }
}
