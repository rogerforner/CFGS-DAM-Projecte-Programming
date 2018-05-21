<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function getHome()
    {
        return view('home');
    }

    public function getLogin()
    {
        return view('login');
    }
}
