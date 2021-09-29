<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::where('type','recurring')->get();
        // dd($plans);

        return view('plan.index', compact('plans'));
    }
}
