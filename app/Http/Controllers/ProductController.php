<?php
namespace App\Http\Controllers;

use App\Jobs\StoreShopifyProducts;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $shop = Auth::user();
        // return $shop;

        $products = Product::where('user_id', $shop->id)->orderBy('id','desc')->get();
        $allProducts = $products->count();
        $charge = $shop->charge ?? "0" ;

        $callForm = 0;
        if ($charge->name == 'Basic Plan')
        {
            if ($allProducts < 3)
            {
                $callForm = 1;
            }
        }
        elseif ($charge->name == 'Super Plan')
        {
            if ($allProducts < 10)
            {
                $callForm = 1;
            }
        }
        else
        {
            $callForm = 1;
        }

        return view('product.list',compact('shop','products','charge','callForm'));
    }

    public function importProducts()
    {
        $getStore = Auth::user();

        StoreShopifyProducts::dispatch($getStore);
        return response()->json("success");

        // $pageInfo = "";
        // $lastPage = false;
        // $totalProduct = 0;

        // while (!$lastPage)
        // {
        //     $url = "https://" . $getStore->shop_domain . config('constant.shopify_api_version') . "/products.json?page_info=" . $pageInfo . "&limit=250";

        //     $getAllProducts = Http::withHeaders([
        //             'Accept'                    =>  'application/json',
        //             'Content-Type'              =>  'application/json',
        //             'X-Shopify-Access-Token'    =>  $getStore->password,
        //         ])->get($url);

        //     $apiResponseHeaders = $getAllProducts->headers();

        //     if (collect($getAllProducts['products'])->count() == 250)
        //     {
        //         $pageInfo = Str::between($apiResponseHeaders['Link'][0], 'page_info=', '>; rel="next"');
        //         if (Str::contains($apiResponseHeaders['Link'][0], 'rel="next"'))
        //         {
        //         }
        //         else
        //         {
        //             $lastPage = true;
        //         }
        //     }
        //     else
        //     {
        //         $lastPage = true;
        //     }

        //     // $totalProduct += collect($getAllProducts['products'])->count();
        //     // Log::info($totalProduct);

        //     foreach($getAllProducts['products'] as $product)
        //     {
        //         // dd(config('constant.product.status_code.'.$product['status']));
        //         Product::updateOrCreate(
        //             [
        //                 'user_id'               =>  $this->getStore->id,
        //                 'product_id'            =>  $product['id'] ?? ' ',
        //             ],

        //             [
        //                 'title'                 =>  $product['title'] ?? ' ',
        //                 'description'           =>  $product['body_html'] ?? ' ',
        //                 'vendor'                =>  $product['vendor'] ?? ' ',
        //                 'type'                  =>  $product['product_type'] ?? ' ',
        //                 'handle'                =>  $product['handle'] ?? ' ',
        //                 'product_created_at'    =>  date('Y-m-d H:i:s',strtotime($product['created_at'])) ?? ' ',
        //                 'product_updated_at'    =>  date('Y-m-d H:i:s',strtotime($product['updated_at'])) ?? ' ',
        //                 // 'status'                =>  $product['status'] ?? ' ',
        //                 'status'                =>  config('constant.product.status_code.' . $product['status']),
        //                 'tags'                  =>  $product['tags'] ?? ' ',
        //                 'image'                 =>  $product['image']['src'] ?? ' '
        //             ]
        //         );
        //     }
        // }
    }

    public function create()
    {
        $shop = Auth::user();
        $allProducts = Product::where("user_id",$shop->id)->count();
        $charge = $shop->charge ?? "0";
        $callForm = 0;
        if ($charge->name == 'Basic Plan')
        {
            if ($allProducts < 3)
            {
                $callForm = 1;
            }
        }
        elseif ($charge->name == 'Super Plan')
        {
            if ($allProducts < 10)
            {
                $callForm = 1;
            }
        }
        else
        {
            $callForm = 1;
        }
        return view('product.create',compact('shop','charge','callForm'));
    }

    public function store(Request $request)
    {
        $shop = Auth::user();

        $productData = [
            'product' => [
                'title'         =>  $request->title,
                'body_html'     =>  $request->description,
                'vendor'        =>  $request->vendor,
                'product_type'  =>  $request->type,
            ],
        ];
        $newProduct = User::makeApiCall('products.json','post','product', $productData, $shop->password, $shop->shop_domain);

        $data = $request->all();
        $data['user_id'] = $shop->id;
        $data['product_id'] = $newProduct['id'];
        $isSave = Product::create($data);

        if ($isSave)
        {
            return response()->json('success');
        }
        else
        {
            return response()->json('fail');
        }
    }

    public function edit(Request $request)
    {
        $getProduct = Product::find($request->id);
        return response()->json($getProduct);
    }

    public function update(Request $request)
    {
        $shop = Auth::user();

        $updatedProductData = [
            'product' => [
                'id'            =>  $request->product_id,
                'title'         =>  $request->title,
                'body_html'     =>  $request->description,
                'vendor'        =>  $request->vendor,
                'product_type'  =>  $request->type
            ],
        ];
        $updateProduct = User::makeApiCall('products/'.$request->product_id.'.json','put','product', $updatedProductData, $shop->password, $shop->shop_domain);

        $getProduct = Product::find($request->id);
        $getProduct->user_id        =   $shop->id;
        $getProduct->title          =   $request->title;
        $getProduct->description    =   $request->description;
        $getProduct->vendor         =   $request->vendor;
        $getProduct->type           =   $request->type;
        $isUpdate = $getProduct->save();

        if ($isUpdate)
        {
            return response()->json('success');
        }
        else
        {
            return response()->json('fail');
        }
    }

    public function delete(Request $request)
    {
        $getProduct = Product::find($request->id);
        $shop = Auth::user();

        $updateProduct = User::makeApiCall('products/'.$getProduct->product_id.'.json', 'delete', '', [], $shop->password, $shop->shop_domain);
        $isDelete = $getProduct->delete();

        if ($isDelete)
        {
           return response()->json('success');
        }
        else
        {
            return response()->json('fail');
        }
    }
}
