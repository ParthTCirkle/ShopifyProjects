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
        // $link = "";
        $response = $shop->api()->rest('GET', '/admin/api/2021-07/customers.json', ['limit' => $limit, 'page_info' => $link]);
        if ($response['status'] != 200)
        {
            abort(401);
        }
        // dump($response['status']);
        $next = $response['link']['next'] ?? null;
        // dump($next);
        $previous = $response['link']['previous'] ?? null;
        // dump($previous);
        $customers = $response['body']['customers'];
        // dd($response['body']['customers']);
        return view('customer.index', compact('customers', 'next', 'previous'));
    }

    public function customerSync()
    {
        $shop = Auth::user();
        SyncCustomerJob::dispatch($shop);
        return redirect(route('customer.index'));
    }
}
