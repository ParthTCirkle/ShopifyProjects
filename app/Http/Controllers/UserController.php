<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public $shopify_api_key = null;
    public $shopify_api_secret = null;
    public $shop = null;


    public function __construct()
    {
        // Configuration
        $this->shopify_api_key = config('constant.shopify_api_key');
        $this->shopify_api_secret = config('constant.shopify_api_secret');
        // Models
        $this->user = new User();
    }

    public function index(Request $request)
    {
        // dump($request->all());
        $this->shop = $request->get('shop');
        // dump($this->shop);
        $getStore = $this->user->where('shop_domain', $this->shop)->latest()->first();
        // dump($getStore);

        //Retrieve all products
        $url = "https://" . $this->shop . config('constant.shopify_api_version') . "/users/current.json";
        dump("https://". $this->shop . config('constant.shopify_api_version') . "/users/current.json");
        $getAllUsers = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $getStore->password,
        ])->get($url);
        dump($getAllUsers->json());
        dd();
        $apiResponse = [];
        $apiResponse = array_merge($apiResponse, $getAllUsers['users']);
        // dump($apiResponse);
    }
}
