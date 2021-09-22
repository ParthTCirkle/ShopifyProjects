<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatePlanCreate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $shop = User::with('charge')->where("shop_domain",$request->shop)->latest()->first();
        if($shop->shop_domain == "app-store-dev.myshopify.com")
        {
            Auth::setUser($shop);
            return $next($request);
        }

        return abort(401);
    }
}
