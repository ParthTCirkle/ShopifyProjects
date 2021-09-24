<?php

namespace App\Http\Controllers;

use App\Jobs\SyncProductJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Osiset\ShopifyApp\Services\ChargeHelper;

class ProductController extends Controller
{
    public function index()
    {
        $shop = Auth::user();
        // dd($shop);
        // $shopApi = $shop->api()->rest('GET', '/admin/api/2021-07/shop.json')['body']['shop'];
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
        return view('product.index');
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
        $getStore = Auth::user();

        SyncProductJob::dispatch($getStore);
        // return back();
        // return response()->json("success");
    }

    public function edit()
    {
        return view('product.edit');
    }
}
