<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ChargeController extends Controller
{
    public function create(Request $request)
    {
        $shop = Auth::user();
        // dump($shop);
        $allProducts = Product::where("user_id",$shop->id)->get()->count();
        $currentPlan = $shop->charge->plan_id ?? 0;
        $plan = Plan::where("id",$request->id)->first();

        if ($request->id < $currentPlan)
        {
            if ($shop->charge->name == "Super Plan" && $plan->plan_name == "Basic Plan")
            {
                if ($allProducts > 3)
                {
                    return "product list";
                }
            }
            elseif($shop->charge->name == "Premium Plan" && $plan->plan_name == "Super Plan")
            {
                if ($allProducts > 10)
                {
                    return "product list";
                }
            }
            elseif($shop->charge->name == "Premium Plan" && $plan->plan_name == "Basic Plan")
            {
                if ($allProducts > 3) {
                    return "product list";
                }
            }
        }

        $planData = [
            'recurring_application_charge' => [
                "name"          =>  $plan['plan_name'],
                "price"         =>  $plan['price'],
                "return_url"    =>  "https://".$shop->shop_domain."/admin/apps/test-app-3694/",
                "test"          =>  $plan['test'],
                "trial_days"    =>  $plan['trial_days'],
                "capped_amount" =>  $plan['capped_amout'],
                "terms"         =>  $plan['terms'],
            ],
        ];

        $createRAC = User::makeApiCall('recurring_application_charges.json','post','recurring_application_charge', $planData, $shop->password, $shop->shop_domain);
        return $createRAC['confirmation_url'];
    }
}
