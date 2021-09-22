<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
class DiscountController extends Controller
{
    public function view()
    {
        $shop = auth()->user();
        $charge = $shop->charge ?? "0" ;

        return view('discount.create',compact('shop','charge'));
    }
}
