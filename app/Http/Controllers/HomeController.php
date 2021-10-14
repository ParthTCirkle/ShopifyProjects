<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function index()
    {
        // dump(session()->all());
        // dd(Auth::user());
        return view('welcome');
    }

    public function proxy()
    {
        return "hello this is my proxy url";
    }
}
