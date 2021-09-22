<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ScriptController extends Controller
{
    public function list()
    {
        $shop = auth()->user();
        $charge = $shop->charge ?? "0" ;

        $themes = User::makeApiCall('themes.json','get','themes', [], $shop->password, $shop->shop_domain);

        // $url = "https://".$shop->shop_domain.config('constant.shopify_api_version')."/themes.json";
        // $getAllThemes = Http::withHeaders([
        //         'Accept'                    =>  'application/json',
        //         'Content-Type'              =>  'application/json',
        //         'X-Shopify-Access-Token'    =>  $shop->password,
        //     ])->get($url);
        // $themes = $getAllThemes['themes'];

        return view('installation.create',compact('shop','themes','charge'));

        // $url = "https://".$getStore->shop_domain.config('constant.shopify_api_version')."/script_tags.json";
        // $getAllScripttags = Http::withHeaders([
        //         'Accept'                    =>  'application/json',
        //         'Content-Type'              =>  'application/json',
        //         'X-Shopify-Access-Token'    =>  $getStore->password,
        //     ])->get($url);
        // dd($getAllScripttags->json());

        // $data = [
        //     "script_tag" => [
        //         "event" => "onload",
        //         "src" => "https://testapp5.snigre.com/public/assets/js/custom.js",
        //         ]
        //     ];

        // $url = "https://" . $getStore->shop_domain . config('constant.shopify_api_version') . "/script_tags.json";
        // $createScripttag = Http::withHeaders([
        //     'Accept'                    =>  'application/json',
        //     'Content-Type'              =>  'application/json',
        //     'X-Shopify-Access-Token'    =>  $getStore->password
        // ])->post($url, $data);
        // dd($createScripttag->json());

        // $url = "https://".$getStore->shop_domain.config('constant.shopify_api_version')."/themes.json";
        // $parameter = ['role' => 'main'];

        // $getAllThemes = Http::withHeaders([
        //         'Accept'                    =>  'application/json',
        //         'Content-Type'              =>  'application/json',
        //         'X-Shopify-Access-Token'    =>  $getStore->password,
        //     ])->get($url,$parameter);

        // $url = URL::to('public/assets/liquid/demoliquidfile.liquid');
        // // dd($url);
        // $data = [
        //     "asset" => [
        //         "key" => "sections/demoliquidfile.liquid",
        //         "src" => $url,
        //         ]
        //     ];

        // $url = "https://" . $getStore->shop_domain . config('constant.shopify_api_version') . "/themes/". $getAllThemes['themes'][0]['id'] ."/assets.json";
        // $updateThemeAsset = Http::withHeaders([
        //     'Accept'                    =>  'application/json',
        //     'Content-Type'              =>  'application/json',
        //     'X-Shopify-Access-Token'    =>  $getStore->password
        // ])->put($url, $data);

        // dd($updateThemeAsset->json());

        //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // $url = "https://".$getStore->shop_domain.config('constant.shopify_api_version')."/themes/".$getAllThemes['themes'][0]['id']."/assets.json?asset[key]=sections/cart-template.liquid";

        // $getAllAssets = Http::withHeaders([
        //         'Accept'                    =>  'application/json',
        //         'Content-Type'              =>  'application/json',
        //         'X-Shopify-Access-Token'    =>  $getStore->password,
        //     ])->get($url);

        // $content = "{{ cart.total_price | money_with_currency }}";

        // if (Str::contains($getAllAssets['asset']['value'], $content))
        // {
        //     $data = [
        //         "asset" => [
        //             "key" => $getAllAssets['asset']['key'],
        //             "value" => Str::of($getAllAssets['asset']['value'])->replace($content, "<span id='appended'>".$content."</span>"),
        //         ]
        //     ];

        //     $url = "https://" . $getStore->shop_domain . config('constant.shopify_api_version') . "/themes/". $getAllThemes['themes'][0]['id'] ."/assets.json";
        //     $updateThemeAsset = Http::withHeaders([
        //         'Accept'                    =>  'application/json',
        //         'Content-Type'              =>  'application/json',
        //         'X-Shopify-Access-Token'    =>  $getStore->password
        //     ])->put($url, $data);
        //     dd($updateThemeAsset->json());
        // } else
        // {
        //     dd("no");
        // }
    }


    public function create(Request $request)
    {
        $getStore = auth()->user();

        $url = "https://".$getStore->shop_domain.config('constant.shopify_api_version')."/themes/". $request->id ."/assets.json?asset[key]=layout/theme.liquid";

        $getAllAssets = Http::withHeaders([
                'Accept'                    =>  'application/json',
                'Content-Type'              =>  'application/json',
                'X-Shopify-Access-Token'    =>  $getStore->password,
            ])->get($url);

        $url = URL::to('/public/assets/js/custom.js');
        $link = "<script src='$url'></script>\r\n";

        switch (Str::contains($getAllAssets['asset']['value'], $link))
        {
            case true:
                return response()->json('contains');
            break;

            case false:
                $data = [
                    "asset" => [
                        "key" => $getAllAssets['asset']['key'],
                        "value" => Str::of($getAllAssets['asset']['value'])->replace('</head>', $link.'</head>'),
                    ]
                ];

                $url = "https://" . $getStore->shop_domain . config('constant.shopify_api_version') . "/themes/".  $request->id  ."/assets.json";
                $updateThemeAsset = Http::withHeaders([
                    'Accept'                    =>  'application/json',
                    'Content-Type'              =>  'application/json',
                    'X-Shopify-Access-Token'    =>  $getStore->password
                ])->put($url, $data);
                return response()->json('success');
            break;

            default:
            break;
        }

    }
}
