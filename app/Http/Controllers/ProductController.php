<?php

namespace App\Http\Controllers;

use App\Jobs\SyncProductJob;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Osiset\ShopifyApp\Services\ChargeHelper;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index($link = null)
    {
        $shop = Auth::user();
        $limit = 250;
        $response = $shop->api()->rest('GET', '/admin/api/2021-07/products.json', ['limit' => $limit, 'page_info' => $link]);
        if ($response['status'] != 200)
        {
            abort(401);
        }
        $next = $response['link']['next'] ?? null;
        $previous = $response['link']['previous'] ?? null;
        $products = $response['body']['products'];

        $response = $shop->api()->rest('GET', '/admin/api/2021-07/products/count.json');
        $totalProducts = $response['body']['count'];

        return view('product.index', compact('next', 'previous', 'products', 'totalProducts'));


        // $allStores = User::select('*')->whereNotIn('password',[' '])->get();
        // // $allStores = User::where()
        // foreach($allStores as $store)
        // {
        //     // dump($store);
        //     $pageInfo = "";
        //     $lastPage = false;
        //     $totalProduct = 0;
        //     while (!$lastPage)
        //     {
        //         $url = "https://".$store->name.config('constant.shopify_api_version')."/products.json?page_info=".$pageInfo."&limit=250";
        //         $getAllProducts = Http::withHeaders([
        //                 'Accept'                    =>  'application/json',
        //                 'Content-Type'              =>  'application/json',
        //                 'X-Shopify-Access-Token'    =>  $store->password,
        //             ])->get($url);
        //         $apiResponseHeaders = $getAllProducts->headers();
        //         if (collect($getAllProducts['products'])->count() == 250)
        //         {
        //             $pageInfo = Str::between($apiResponseHeaders['Link'][0], 'page_info=', '>; rel="next"');
        //         }
        //         else
        //         {
        //             $lastPage = true;
        //         }
        //         foreach($getAllProducts['products'] as $product)
        //         {
        //             // dd($product['tags'].", new tag");
        //             $updatedProductData = [
        //                 'product' => [
        //                     'id'            =>  $product['id'],
        //                     'tags'         =>   $product['tags'].", cirkle",
        //                 ],
        //             ];
        //             $url = "https://".$store->name.config('constant.shopify_api_version')."/products/".$product['id'].".json";
        //             // dd($url);
        //             $success = Http::withHeaders([
        //                 'Accept'                    =>  'application/json',
        //                 'Content-Type'              =>  'application/json',
        //                 'X-Shopify-Access-Token'    =>  $store->password,
        //             ])->put($url,$updatedProductData);
        //         }
        //     }
        // }
        // dd('10');

        // dd("hello");



        // dd($shop);
        // $shopApi = $shop->api()->rest('GET', '/admin/api/2021-07/shop.json')['body']['shop'];
        // return $shopApi;
        // dd($shopApi);

        // product create
        // $productData = [
        //     'product' => [
        //         'title'         =>  'custom premium',
        //         'body_html'     =>  '<strong>Good snowboard!</strong>',
        //         'vendor'        =>  'Burton',
        //         'product_type'  =>  'Snowboard',
        //         'tags'          =>  ["Barnes & Noble", "Big Air", "John's Fav"],
        //     ],
        // ];
        // $shop = Auth::user();
        // $productCreate = $shop->api()->rest('post', '/admin/api/2021-07/products.json', $productData)['body']['product'];
        // dd($productCreate);

        // $productData = [
        //     'product' => [
        //         'id'            =>  $productCreate->id,
        //         'title'         =>  'custom premium updated',
        //         'body_html'     =>  '<p>Its the small iPod with one very big idea: Video. Now the worlds most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just $149, little speaks volumes.</p>',
        //         'vendor'        =>  'Burton',
        //         'product_type'  =>  'Snowboard',
        //         'tags'          =>  ["Barnes & Noble", "Big Air", "John's Fav"],
        //     ],
        // ];

        // $result = $shop->api()->rest('put', '/admin/api/2021-07/products/' . $productCreate->id . '.json', $productData)['body']['product'];
        // dd($result);

        // $result = $shop->api()->rest('delete', '/admin/api/2021-07/products/' . $productCreate->id . '.json', $productData);
        // dd($result);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
    }

    public function productSync()
    {
        $shop = Auth::user();

        SyncProductJob::dispatch($shop);

        // return redirect(route('product.index'));
        // dd('start');
    }

    public function edit()
    {
        return view('product.edit');
    }
}
