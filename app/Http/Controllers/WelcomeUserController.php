<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    public function name(string $name)
    {
        return 'Hello ' . ucfirst($name);
    }

    public function nickname(string $name, string $nickname)
    {
        $name = ucfirst($name);

        return "Hello $name whose nickname is $nickname";
    }
}


