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
use Illuminate\Support\Str;


class SyncProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $shop;
    public $timeout = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($shop)
    {
        $this->shop = $shop;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit', '1024M');

        $pageInfo = "";
        $lastPage = false;
        $limit = 250;
        while (!$lastPage)
        {
            $response = $this->shop->api()->rest('GET', '/admin/api/2021-07/products.json', ['limit' => $limit, 'page_info' => $pageInfo]);

            if (collect($response['body']['products'])->count() == $limit)
            {
                $pageInfo = $response['link']['next'];
            }
            else
            {
                $lastPage = true;
            }

            foreach($response['body']['products'] as $product)
            {
                Product::updateOrCreate(
                    [
                        'user_id'               =>  $this->shop->id,
                        'product_id'            =>  $product->id ?? ' ',
                    ],
                    [
                        'title'                 =>  $product->title ?? ' ',
                        'description'           =>  $product->body_html ?? ' ',
                        'vendor'                =>  $product->vendor ?? ' ',
                        'type'                  =>  $product->product_type ?? ' ',
                        'handle'                =>  $product->handle ?? ' ',
                        'product_created_at'    =>  date('Y-m-d H:i:s',strtotime($product->created_at)) ?? ' ',
                        'product_updated_at'    =>  date('Y-m-d H:i:s',strtotime($product->updated_at)) ?? ' ',
                        'status'                =>  config('constant.product.status_code.'.$product->status),
                        'tags'                  =>  $product->tags ?? ' ',
                        'image'                 =>  $product->image->src ?? ' '
                    ]
                );
            }
        }
    }
}
