<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PHPUnit\Exception;


class StoreShopifyProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $getStore;
    public $timeout = 0;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($getStore)
    {
        $this->getStore = $getStore;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // ini_set('max_execution_time', 50000);
        ini_set('memory_limit', '1024M');
        // set_time_limit(0);

        $pageInfo = "";
        $lastPage = false;
        $totalProduct = 0;

        while (!$lastPage)
        {
            $url = "https://".$this->getStore->shop_domain.config('constant.shopify_api_version')."/products.json?page_info=".$pageInfo."&limit=250";

            $getAllProducts = Http::withHeaders([
                    'Accept'                    =>  'application/json',
                    'Content-Type'              =>  'application/json',
                    'X-Shopify-Access-Token'    =>  $this->getStore->password,
                ])->get($url);

            $apiResponseHeaders = $getAllProducts->headers();

            if (collect($getAllProducts['products'])->count() == 250)
            {
                $pageInfo = Str::between($apiResponseHeaders['Link'][0], 'page_info=', '>; rel="next"');
                if (Str::contains($apiResponseHeaders['Link'][0], 'rel="next"'))
                {
                }
                else
                {
                    $lastPage = true;
                }
            }
            else
            {
                $lastPage = true;
            }

            // $totalProduct += collect($getAllProducts['products'])->count();
            // Log::info($totalProduct);

            foreach($getAllProducts['products'] as $product)
            {
                Product::updateOrCreate(
                    [
                        'user_id'               =>  $this->getStore->id,
                        'product_id'            =>  $product['id'] ?? ' ',
                    ],
                    [
                        'title'                 =>  $product['title'] ?? ' ',
                        'description'           =>  $product['body_html'] ?? ' ',
                        'vendor'                =>  $product['vendor'] ?? ' ',
                        'type'                  =>  $product['product_type'] ?? ' ',
                        'handle'                =>  $product['handle'] ?? ' ',
                        'product_created_at'    =>  date('Y-m-d H:i:s',strtotime($product['created_at'])) ?? ' ',
                        'product_updated_at'    =>  date('Y-m-d H:i:s',strtotime($product['updated_at'])) ?? ' ',
                        'status'                =>  config('constant.product.status_code.'.$product['status']),
                        'tags'                  =>  $product['tags'] ?? ' ',
                        'image'                 =>  $product['image']['src'] ?? ' '
                    ]
                );
            }
        }
    }
}
