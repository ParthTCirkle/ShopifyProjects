<?php

namespace App\Http\Middleware;

use App\Http\Controllers\OAuthController;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopifyAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        $hmac = $request->get('hmac');
        $requestParams = array_diff_key($request->all(), ['hmac' => '']);
        ksort($requestParams);

        $computedHmac = hash_hmac('sha256', http_build_query($requestParams), config('constant.shopify_api_secret'));

        if (hash_equals($hmac, $computedHmac)) {
            $shop = User::with('charge')->where('shop_domain', $request->shop)->first();
            if ($shop) {
                Auth::setUser($shop);
                return $next($request);
            } else {
                return abort(401);
            }
        } else {
            return abort(401);
        }
    }
}
