<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class AssetController extends Controller
{
    public function index()
    {
        $shop = auth()->user();
        $charge = $shop->charge ?? "0" ;
        $themes = User::makeApiCall('themes.json','get','themes', [], $shop->password, $shop->shop_domain);

        return view('asset.create',compact('shop','themes','charge'));
    }

    public function create(Request $request)
    {
        $shop = auth()->user();
        $hasAsset = User::makeApiCall('themes/'.$request->id.'/assets.json?asset[key]=sections/demoliquidfile.liquid','get','asset', [], $shop->password, $shop->shop_domain);

        // $url = "https://".$shop->shop_domain.config('constant.shopify_api_version')."/themes/".$request->id."/assets.json?asset[key]=sections/demoliquidfile.liquid";
        // $hasAsset = Http::withHeaders([
        //     'Accept'                    =>  'application/json',
        //     'Content-Type'              =>  'application/json',
        //     'X-Shopify-Access-Token'    =>  $shop->password,
        // ])->get($url);

        if($hasAsset->json())
        {
            return response()->json("available");
        }
        else
        {
            $url = URL::to('public/assets/liquid/demoliquidfile.liquid');
            // dd($url);
            $data = [
                "asset" => [
                    "key" => "sections/demoliquidfile.liquid",
                    "src" => $url,
                    ]
                ];

            $hasAsset = User::makeApiCall('themes/'.$request->id.'/assets.json','put','asset', $data, $shop->password, $shop->shop_domain);

            // $url = "https://" . $shop->shop_domain . config('constant.shopify_api_version') . "/themes/". $request->id ."/assets.json";
            // $updateThemeAsset = Http::withHeaders([
            //     'Accept'                    =>  'application/json',
            //     'Content-Type'              =>  'application/json',
            //     'X-Shopify-Access-Token'    =>  $shop->password
            // ])->put($url, $data);
            return response()->json("success");
        }
    }
}
