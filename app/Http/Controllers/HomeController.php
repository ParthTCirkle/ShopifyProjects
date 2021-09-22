<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Charge;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // dd('hello');
        $shop = auth()->user();

        if ($request->charge_id) {
            $url = "https://" . $shop->shop_domain . config('constant.shopify_api_version') . "/recurring_application_charges/" . $request->charge_id . ".json";
            $data = Http::withHeaders([
                'Accept'                    =>  'application/json',
                'Content-Type'              =>  'application/json',
                'X-Shopify-Access-Token'    =>  $shop->password,
            ])->get($url);
            $response = $data['recurring_application_charge'];

            $plan = Plan::where("plan_name", $response['name'])->latest()->first();

            if ($response['status'] == 'active') {
                $isSave = Charge::updateOrCreate(
                    [
                        'user_id'       =>  $shop->id
                    ],
                    [
                        'charge_id'     =>  $response['id'],
                        'plan_id'       =>  $plan->id,
                        'name'          =>  $response['name'],
                        'price'         =>  $response['price'],
                        'trial_days'    =>  $response['trial_days'],
                        'status'        =>  config('constant.charge.status_code.'.$response['status']),
                        'test'          =>  $response['test'],
                        'billing_on'    =>  date('Y-m-d H:i:s', strtotime($response['billing_on'])),
                        'activated_on'  =>  date('Y-m-d H:i:s', strtotime($response['activated_on'])),
                        'cancelled_on'  =>  $response['cancelled_on'] ?? null,
                        'trial_ends_on'  =>  $response['trial_ends_on'] ?? null,
                    ]
                );
            }
        }

        $charge = $shop->charge ?? "0";
        return view('welcome', compact('shop', 'charge'));
    }

    public function test()
    {
        // dump($request->all());
        $passwords = [
            'app-store-dev.myshopify.com' => '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',
            'test-cirke.myshopify.com' => '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',
            'all-in-one-auto-discount.myshopify.com' => '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',
            'multi-stores-locator.myshopify.com' => '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',
            'test-app-install-cirkle.myshopify.com' => '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'
        ];

        foreach ($passwords as $key => $password)
        {
            dump($key);
            dump('original : ' . $password);
            $length = env('ADD_STRING_LENGTH');
            $positions = [1, 8, 16, 20, 28, 35, 40];

            $password = Str::after($password, 'shpat_');
            // $splitedPassword = str_split($password); // convert string into array
            foreach ($positions as $position)
            {
                $string = substr(str_shuffle('abcdef0123456789'), 0, $length);
                $password = substr_replace($password, $string, $position, 0); // add extra string on different positions
            }
            $password = 'shpat_' . $password;
            dump('encrypted : ' . $password);

            $positions = array_reverse($positions);
            $decryptrdPassword = Str::after($password, 'shpat_');
            foreach ($positions as $position)
            {
                $decryptrdPassword = substr_replace($decryptrdPassword, '', $position, $length); // remove extra added string from different positions
            }
            $result = 'shpat_' . $decryptrdPassword;
            dump('decrypted : ' . $result);
        }
    }

    public function redirectToInstallPage()
    {
        $shop = Auth::user();
        $oauthController = new OAuthController;
        $response = $oauthController->redirectToInstallPage($shop->shop_domain);
        return "<script> window.top.location.href = '$response'; </script>";
    }

    public function proxy()
    {
        return "Hello this is my proxy url";
    }
}
