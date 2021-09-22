<?php

namespace App\Http\Middleware;

use App\Http\Controllers\OAuthController;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ShopifyAjaxAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        $shop = $request->header('shop');
        $shop = User::with('charge')->where('shop_domain',$shop)->first();
        // $currentAppVersion = config('constant.app_version');
        // if ($shop->app_version < $currentAppVersion)
        // {
        //     $oauthController = new OAuthController;
        //     $response = $oauthController->redirectToInstallPage($shop->shop_domain);
        //     // dump("redirect to install page");
        //     return "<script> window.top.location.href = '$response'; </script>";
        // }

        if ($request->ajax())
        {
            $token = $request->bearerToken();
            $decrypted = Crypt::decrypt($token);

            if ($shop->token === $decrypted)
            {
                Auth::setUser($shop);
                return $next($request);
            }
        }
        else
        {
            return abort(401);
        }
    }
}
