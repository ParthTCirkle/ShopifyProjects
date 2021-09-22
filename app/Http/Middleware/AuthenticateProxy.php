<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateProxy
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
        $signature = $request->get('signature');
        $requestParams = array_diff_key($request->all(), ['signature' => '']);
        ksort($requestParams);
        $query = str_replace("%2F", "/", http_build_query($requestParams));
        $query = str_replace("&", "", $query);
        $computedSignature = hash_hmac('sha256', $query, config('constant.shopify_api_secret'));
        
        if (hash_equals($signature, $computedSignature))
        {
            return $next($request);
        }
        else
        {
            return abort(401);
        }
    }
}
