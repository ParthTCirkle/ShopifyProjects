<?php

namespace App\Jobs;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncCustomerJob implements ShouldQueue
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
            $response = $this->shop->api()->rest('GET', '/admin/api/2021-07/customers.json', ['limit' => $limit, 'page_info' => $pageInfo]);

            if (collect($response['body']['customers'])->count() == $limit)
            {
                $pageInfo = $response['link']['next'];
            }
            else
            {
                $lastPage = true;
            }
            // 'currency', 'tags', 'phone', 'note', 'email', 'last_name', 'first_name', 'customer_id', 'user_id'

            foreach($response['body']['customers'] as $customer)
            {
                Customer::updateOrCreate(
                    [
                        'user_id'       =>  $this->shop->id,
                        'customer_id'   =>  $customer->id ?? ' ',
                    ],
                    [
                        'first_name'    =>  $customer->first_name ?? ' ',
                        'last_name'     =>  $customer->last_name ?? ' ',
                        'email'         =>  $customer->email ?? ' ',
                        'note'          =>  $customer->note ?? ' ',
                        'phone'         =>  $customer->phone ?? ' ',
                        'tags'          =>  $customer->tags ?? ' ',
                        'currency'      =>  $customer->currency ?? ' '
                    ]
                );
            }
        }
    }
}
