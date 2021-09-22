<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ShopifyWebhookController extends Controller
{
    public $user = NULL;

    public function __construct()
    {
        // Models
        $this->user = new User();
    }

    public function webhookCallback(Request $request)
    {
        // Log::info("Received webhook callback");
        $data = json_decode($request->getContent(), true);
        $shop = $request->header('x-shopify-shop-domain');
        $topic = $request->header('x-shopify-topic');

        $getStore = $this->user->where('shop_domain', $shop)->first();
        if ($getStore)
        {
            switch ($topic)
            {
                case 'app/uninstalled':
                    $this->shopifyAppUninstalled($getStore);
                break;

                case 'shop/update':
                    $this->shopifyShopUpdate($getStore, $data);
                break;


                case 'products/create':
                    $this->shopifyProductsCreateOrUpdate($data);
                break;

                case 'products/update':
                    $this->shopifyProductsCreateOrUpdate($data);
                    // $this->shopifyProductsUpdate($data);
                break;

                case 'products/delete':
                    $this->shopifyProductsDelete($data);
                break;


                // case 'customers/create':
                //     $this->shopifyCustomersCreate($data);
                // break;

                // case 'customers/disable':
                //     $this->shopifyCustomersDisable($data);
                // break;

                // case 'customers/enable':
                //     $this->shopifyCustomersEnable($data);
                // break;

                // case 'customers/update':
                //     $this->shopifyCustomersUpdate($data);
                // break;


                // case 'orders/cancelled':
                //     $this->shopifyOrderscancelled($data);
                // break;

                // case 'orders/create':
                //     $this->shopifyOrdersCreate($data);
                // break;

                // case 'orders/fulfilled':
                //     $this->shopifyOrdersFulfilled($data);
                // break;

                // case 'orders/paid':
                //     $this->shopifyOrdersPaid($data);
                // break;

                // case 'orders/partially_fulfilled':
                //     $this->shopifyOrdersPartiallyFulfilled($data);
                // break;

                // case 'orders/updated':
                //     $this->shopifyOrdersUpdated($data);
                // break;

                // case 'orders/delete':
                //     $this->shopifyOrdersDelete($data);
                // break;

                // case 'orders/edited':
                //     $this->shopifyOrdersEdited($data);
                // break;

                default:
                    Log::alert("Please define case for perticular webhook...");
                break;
            }
        }
        else
        {
            Log::error("User Not Available...");
        }
    }

    public function shopifyAppUninstalled($getStore)
    {
        $storeData = [
            'password' => null,
            'token' => null,
            'status' => config('constant.user.status_code.inactive'),
            'total_install_count' => null,
            'uninstalled_at' => date('Y-m-d H:i:s'),
        ];
        $isUninstall = $getStore->update($storeData);

        if ($isUninstall) {
            Log::info("App uninstalled successfully".$isUninstall);
        }
    }

    public function shopifyShopUpdate($getStore, $data)
    {
        $storeData = [
            'id' => $data['id'],
            'name' => $data['name'],
            'domain' => $data['domain'],
            'timezone' => $data['iana_timezone'],
            'email' => $data['customer_email'],
        ];
        $isUpdate = $getStore->update($storeData);

        if ($isUpdate) {
            Log::info("Shop updated successfully".$isUpdate);
        }
    }


    public function shopifyProductsCreateOrUpdate($data)
    {
        $shop = auth()->user();
        $getProduct = Product::where('product_id', $data['id'])->first();
        if ($getProduct)
        {
            $updatedData = [
                'user_id'               =>  $shop->id,
                'product_id'            =>  $data['id'] ?? ' ',
                'title'                 =>  $data['title'] ?? ' ',
                'description'           =>  $data['body_html'] ?? ' ',
                'vendor'                =>  $data['vendor'] ?? ' ',
                'type'                  =>  $data['product_type'] ?? ' ',
                'handle'                =>  $data['handle'] ?? ' ',
                'product_created_at'    =>  date('Y-m-d H:i:s' ?? ' ',strtotime($data['created_at'])) ?? ' ',
                'product_updated_at'    =>  date('Y-m-d H:i:s' ?? ' ',strtotime($data['updated_at'])) ?? ' ',
                'status'                =>  config('constant.product.status_code.'.$data['status']),
                'tags'                  =>  $data['tags'] ?? ' ',
                'image'                 =>  $data['image']['src'] ?? ' '
            ];
            $isProductUpdate = $getProduct->update($updatedData);

            if ($isProductUpdate)
            {
                Log::info("Product updated successfully...".$isProductUpdate);
            }
        }
        else
        {
            $product = new Product();

            $product->user_id               =   $shop->id;
            $product->product_id            =   $data['id'] ?? ' ';
            $product->title                 =   $data['title'] ?? ' ';
            $product->description           =   $data['body_html'] ?? ' ';
            $product->vendor                =   $data['vendor'] ?? ' ';
            $product->type                  =   $data['product_type'] ?? ' ';
            $product->handle                =   $data['handle'] ?? ' ';
            $product->product_created_at    =   date('Y-m-d H:i:s' ?? ' ',strtotime($data['created_at'])) ?? ' ';
            $product->product_updated_at    =   date('Y-m-d H:i:s' ?? ' ',strtotime($data['updated_at'])) ?? ' ';
            $product->status                =   config('constant.product.status_code.'.$data['status']);
            $product->tags                  =   $data['tags'] ?? ' ';
            $product->image                 =   $data['image']['src'] ?? ' ';
            $isSave = $product->save();

            if ($isSave)
            {
                Log::info("Product created successfully...".$isSave);
            }
        }
    }

    // public function shopifyProductsUpdate($data)
    // {
    //     $shop = auth()->user();
    //     $getProduct = Product::where('product_id', $data['id'])->first();
    //     if ($getProduct)
    //     {
    //         $updatedData = [
    //             'user_id'               =>  $shop->id,
    //             'product_id'            =>  $data['id'] ?? ' ',
    //             'title'                 =>  $data['title'] ?? ' ',
    //             'description'           =>  $data['body_html'] ?? ' ',
    //             'vendor'                =>  $data['vendor'] ?? ' ',
    //             'type'                  =>  $data['product_type'] ?? ' ',
    //             'handle'                =>  $data['handle'] ?? ' ',
    //             'product_created_at'    =>  date('Y-m-d H:i:s' ?? ' ',strtotime($data['created_at'])) ?? ' ',
    //             'product_updated_at'    =>  date('Y-m-d H:i:s' ?? ' ',strtotime($data['updated_at'])) ?? ' ',
    //             'status'                =>  $data['status'] ?? ' ',
    //             'tags'                  =>  $data['tags'] ?? ' ',
    //             'image'                 =>  $data['image']['src'] ?? ' '
    //         ];
    //         $isProductUpdate = $getProduct->update($updatedData);

    //         if ($isProductUpdate)
    //         {
    //             Log::info("Product updated successfully...".$getProduct);
    //         }
    //     }
    //     else
    //     {
    //         Log::alert("Product Not available");
    //     }
    // }

    public function shopifyProductsDelete($data)
    {
        $getProduct = Product::where('product_id', $data['id'])->first();
        if ($getProduct)
        {
            $isDelete = $getProduct->delete();

            if ($isDelete) {
                Log::info("Product deleted successfully...".$isDelete);
            }
        }
        else
        {
            Log::alert("Product Not available");
        }
    }


    // public function shopifyCustomersCreate($data)
    // {
    // }

    // public function shopifyCustomersDisable($data)
    // {
    // }

    // public function shopifyCustomersEnable($data)
    // {
    // }

    // public function shopifyCustomersUpdate($data)
    // {
    // }


    // public function shopifyOrderscancelled($data)
    // {
    // }

    // public function shopifyOrdersCreate($data)
    // {
    // }

    // public function shopifyOrdersFulfilled($data)
    // {
    // }

    // public function shopifyOrdersPaid($data)
    // {
    // }

    // public function shopifyOrdersPartiallyFulfilled($data)
    // {
    // }

    // public function shopifyOrdersUpdated($data)
    // {
    // }

    // public function shopifyOrdersDelete($data)
    // {
    // }

    // public function shopifyOrdersEdited($data)
    // {
    // }
}
