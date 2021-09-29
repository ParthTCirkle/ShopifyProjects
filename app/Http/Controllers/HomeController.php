<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function login()
    {
        return view('login');
    }

    // public function loginPost(Request $request)
    // {
    //     return redirect("https://testapp5.snigre.com/?shop=test-cirke.myshopify.com")
    // }

    public function index()
    {
        return view('welcome');
    }

    public function proxy()
    {
        return "hello this is my proxy url";
    }
}
