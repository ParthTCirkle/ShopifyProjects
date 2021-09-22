<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function list()
    {
        $shop = Auth::user();

        $plans = Plan::with('charges')->get();
        $charge = $shop->charge ?? "0";

        return view('plan.list',compact('shop', 'plans', 'charge'));
    }

    public function create(Request $request)
    {
        $shop = Auth::user();
        $charge = $shop->charge ?? "0";

        return view('plan.create',compact('shop','charge'));
    }

    public function store(Request $request)
    {
        //Auth::user();
        Plan::create($request->all());
        return response()->json("success");
    }

    public function edit(Request $request)
    {
        $getPlan = Plan::find($request->id);
        return response()->json($getPlan);
    }

    public function update(Request $request)
    {
        //Auth::user();
        $getPlan = Plan::find($request->id);
        $getPlan->primary       =   $request->primary;
        $getPlan->plan_name     =   $request->plan_name;
        $getPlan->price         =   $request->price;
        $getPlan->trial_days    =   $request->trial_days;
        $getPlan->test          =   $request->test;
        $getPlan->capped_amout  =   $request->capped_amout;
        $getPlan->terms         =   $request->terms;
        $getPlan->description   =   $request->description;
        $getPlan->save();

        $data = Plan::whereNotIn('id',[$request->id])->update(["primary" => Null]);
        return response()->json('success');
    }

    public function delete(Request $request)
    {
        // Auth::user();
        $getPlan = Plan::find($request->id);
        $checkCharge = Charge::where("plan_id",$request->id)->latest()->first();
        if ($checkCharge)
        {
            return response()->json('fail');
        }
        $isDelete = $getPlan->delete();

        if ($isDelete)
        {
           return response()->json('success');
        }
    }
}
