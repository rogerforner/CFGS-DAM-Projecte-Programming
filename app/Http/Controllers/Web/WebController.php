<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class WebController extends Controller
{
    public function getDashboard()
    {
        return redirect()->action('DashboardController@index');
    }

    public function getLogin()
    {
        return view('auth.login');
    }
}
