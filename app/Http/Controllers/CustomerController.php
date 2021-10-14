<?php

namespace App\Http\Controllers;

use App\Jobs\SyncCustomerJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index($link = null)
    {
        $shop = Auth::user();

        $limit = 10;
        $response = $shop->api()->rest('GET', '/admin/api/2021-07/customers.json', ['limit' => $limit, 'page_info' => $link]);
        if ($response['status'] != 200)
        {
            abort(401);
        }
        $next = $response['link']['next'] ?? null;
        $previous = $response['link']['previous'] ?? null;
        $customers = $response['body']['customers'];

        $response = $shop->api()->rest('GET', '/admin/api/2021-07/customers/count.json');
        $totalCustomer = $response['body']['count'];

        return view('customer.index', compact('customers', 'next', 'previous', 'totalCustomer'));
    }

    public function customerSync()
    {
        $shop = Auth::user();
        SyncCustomerJob::dispatch($shop);
        // return redirect(route('customer.index'));
    }
}
