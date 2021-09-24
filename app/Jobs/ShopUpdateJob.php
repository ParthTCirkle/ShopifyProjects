<?php namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;
use stdClass;

class ShopUpdateJob implements ShouldQueue
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
        info($this->shopDomain->toNative());
        info($this->data->email);
        // info($this->data->primary_locale);
        // info($this->data->iana_timezone);
        // info($this->data->money_in_emails_format);
        // $getStore = User::where('name',$this->shopDomain->toNative())->latest()->first();

        // // $getStore->shop_id = $this->data->id;
        // $getStore->shop_domain = $this->data->myshopify_domain;
        // $getStore->domain = $this->data->domain;
        // $getStore->timezone = $this->data->iana_timezone;
        // $getStore->status = config('constant.user.status_code.active');
        // $isSuccess  = $getStore->save();
        // if ($isSuccess)
        // {
        //     info("Shop detail updated Successfully : ".$isSuccess);
        // }
    }
}
