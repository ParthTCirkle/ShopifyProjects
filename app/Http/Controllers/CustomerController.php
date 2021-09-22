<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    public function view()
    {
        $shop = auth()->user();
        $charge = $shop->charge ?? "0" ;

        return view('customer.list',compact('shop','charge'));
    }

    public function model()
    {
        $shop = auth()->user();
        return view('customer.model',compact('shop'));
    }


    public function index()
    {
        $shop = auth()->user();
        //Retrieve all products
        $url = "https://" . $shop->shop_domain . config('constant.shopify_api_version') . "/customers.json";
        $getAllCustomers = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $shop->password,
        ])->get($url);
        $apiResponse = [];
        $apiResponse = array_merge($apiResponse, $getAllCustomers['customers']);

        //Retrieve a count of all customers
        $url = "https://" . $shop->shop_domain . config('constant.shopify_api_version') . "/customers/count.json";
        $count = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $shop->password,
        ])->get($url);
        dump($count->json());
    }

    public function create()
    {
        $shop = auth()->user();
        $customerData = [
            'customer' => [
                'first_name' => 'Steve',
                'last_name' => 'Lastnameson',
                'email' => 'steve.lastnameson@example.com',
                'phone' => '+15142546011',
                'verified_email' => true,
                'addresses' => [
                    [
                        'address1' => '123 Oak St',
                        'city' => 'Ottawa',
                        'province' => 'ON',
                        'phone' => '555-1212',
                        'zip' => '123 ABC',
                        'last_name' => 'Lastnameson',
                        'first_name' => 'Mother',
                        'country' => 'CA'
                    ]
                ]
            ]
        ];

        //Create a new customer - 5414892601497
        $url = "https://" . $shop->shop_domain . config('constant.shopify_api_version') . "/customers.json";
        $createProduct = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $shop->password,
        ])->post($url, $customerData);
        dump($createProduct->json());
    }

    public function update()
    {
        $shop = auth()->user();
        $updatedCustomerData = [
            'customer' => [
                'id' => 5414892601497,
                'first_name' => 'updated',
                'last_name' => 'Lastnameson updated',
                'email' => 'updated@mail.com',
                'note' => 'Customer is a great guy'
            ],
        ];

        //Update a Customer - 5414892601497
        $url = "https://" . $shop->shop_domain . config('constant.shopify_api_version') . "/customers/5414892601497.json";
        $updateCustomer = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $shop->password,
        ])->put($url, $updatedCustomerData);
        dump($updateCustomer->json());
    }

    public function delete()
    {
        $shop = auth()->user();
            //delete a Customer - 5414892601497
        $url = "https://". $shop->shop_domain . config('constant.shopify_api_version') . "/customers/5414892601497.json";
        $deleteCustomer = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-Shopify-Access-Token' => $shop->password,
        ])->delete($url);
        dump($deleteCustomer->json());
    }
}
