<?php namespace App\Jobs;

use App\Models\Product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;
use stdClass;

class ProductsUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Shop's myshopify domain
     *
     * @var ShopDomain|string
     */
    public $shopDomain;

    /**
     * The webhook data
     *
     * @var object
     */
    public $data;

    /**
     * Create a new job instance.
     *
     * @param string   $shopDomain The shop's myshopify domain.
     * @param stdClass $data       The webhook data (JSON decoded).
     *
     * @return void
     */
    public function __construct($shopDomain, $data)
    {
        $this->shopDomain = $shopDomain;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Convert domain
        $this->shopDomain = ShopDomain::fromNative($this->shopDomain);
        $getStore = User::where('name',$this->shopDomain->toNative())->latest()->first();

        $getProduct = Product::where('product_id', $this->data->id)->first();
        if ($getProduct)
        {
            $updatedData = [
                'user_id'               =>  $getStore->id,
                'product_id'            =>  $this->data->id ?? ' ',
                'title'                 =>  $this->data->title ?? ' ',
                'description'           =>  $this->data->body_html ?? ' ',
                'vendor'                =>  $this->data->vendor ?? ' ',
                'type'                  =>  $this->data->product_type ?? ' ',
                'handle'                =>  $this->data->handle ?? ' ',
                'product_created_at'    =>  date('Y-m-d H:i:s' ?? ' ',strtotime($this->data->created_at)) ?? ' ',
                'product_updated_at'    =>  date('Y-m-d H:i:s' ?? ' ',strtotime($this->data->updated_at)) ?? ' ',
                'status'                =>  config('constant.product.status_code.'.$this->data->status),
                'tags'                  =>  $this->data->tags ?? ' ',
                'image'                 =>  $this->data->image->src ?? ' '
            ];
            $isProductUpdate = $getProduct->update($updatedData);

            if ($isProductUpdate)
            {
                info("Product updated successfully : " . $isProductUpdate);
            }
        }
        else
        {
            $product = new Product();

            $product->user_id               =   $getStore->id;
            $product->product_id            =   $this->data->id ?? ' ';
            $product->title                 =   $this->data->title ?? ' ';
            $product->description           =   $this->data->body_html ?? ' ';
            $product->vendor                =   $this->data->vendor ?? ' ';
            $product->type                  =   $this->data->product_type ?? ' ';
            $product->handle                =   $this->data->handle ?? ' ';
            $product->product_created_at    =   date('Y-m-d H:i:s' ?? ' ',strtotime($this->data->created_at)) ?? ' ';
            $product->product_updated_at    =   date('Y-m-d H:i:s' ?? ' ',strtotime($this->data->updated_at)) ?? ' ';
            $product->status                =   config('constant.product.status_code.'.$this->data->status);
            $product->tags                  =   $this->data->tags ?? ' ';
            $product->image                 =   $this->data->image->src ?? ' ';
            $isSave = $product->save();

            if ($isSave)
            {
                info("Product created successfully : " . $isSave);
            }
        }

        // Do what you wish with the data
        // Access domain name as $this->shopDomain->toNative()
    }
}
