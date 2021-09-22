<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;
use App\Models\User;

class CreateShopifyWebhook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $request;
    public $store;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $store)
    {
        $this->request = $request;
        $this->store   = $store;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $webhooks = config('constant.shopify_webhooks');

        foreach ($webhooks as $webhook)
        {
            $webhookData = [
                'webhook' => [
                    'topic'     =>      $webhook,
                    'address'   =>      route('webhookCallback'),
                    'format'    =>     'json',
                ],
            ];
            sleep(0.5);
            // $response = User::makeApiCall('webhooks.json','post','webhook', $webhookData, $this->store->password, $this->store->shop_domain);
            $url = "https://" . $this->store->shop_domain . config('constant.shopify_api_version') . '/webhooks.json';
            $response = Http::withHeaders([
                                'Accept'                    =>  'application/json',
                                'Content-Type'              =>  'application/json',
                                'X-Shopify-Access-Token'    =>  $this->store->password,
                            ])->post($url, $webhookData);
            Log::info("webhook created successfully".$response);
        }
    }
}
