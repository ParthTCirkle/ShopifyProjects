<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyWebhook
{
    public function handle(Request $request, Closure $next)
    {
        $hmac = $request->header('x-shopify-hmac-sha256') ?: '';
        $shop = $request->header('x-shopify-shop-domain');
        $data = $request->getContent();

        // From https://help.shopify.com/api/getting-started/webhooks#verify-webhook
        $hmacLocal = base64_encode(hash_hmac('sha256', $data, env('SHOPIFY_API_SECRET'), true));
        if (!hash_equals($hmac, $hmacLocal) || empty($shop)) {
            // Issue with HMAC or missing shop header
            abort(401, 'Invalid webhook signature');
        }

        $user = User::where('shop_domain',$shop)->first();
        Auth::setUser($user);
        return $next($request);
    }
}
