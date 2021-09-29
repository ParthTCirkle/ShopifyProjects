<?php

namespace App\Http\Controllers;

use App\Jobs\SyncProductJob;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Osiset\ShopifyApp\Services\ChargeHelper;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index($link = null)
    {
        // dump($link);
        $shop = Auth::user();
        $limit = 250;
        $response = $shop->api()->rest('GET', '/admin/api/2021-07/products.json', ['limit' => $limit, 'page_info' => $link]);
        if ($response['status'] != 200)
        {
            abort(401);
        }
        // dump($response['status']);
        $next = $response['link']['next'] ?? null;
        // dump($response['link']['next']);
        $previous = $response['link']['previous'] ?? null;
        // dump($response['link']['previous']);
        $products = $response['body']['products'];
        // dd($response['body']['products']);

        return view('product.index', compact('next', 'previous', 'products'));


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

    public function next(Request $request)
    {
        dd($request->all());
    }

    public function previous(Request $request)
    {
        dd($request->all());
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

        return redirect(route('product.index'));
        // dd('start');
    }

    public function edit()
    {
        return view('product.edit');
    }
}
