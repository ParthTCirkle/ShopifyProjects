<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use PHPUnit\Exception;
use Illuminate\Support\Str;

class OAuthController extends Controller
{
    public $shopify_api_key = null;
    public $shopify_api_secret = null;
    public $access_token = null;
    public $shop = null;

    public function __construct()
    {
        $this->shopify_api_key = config('constant.shopify_api_key');
        $this->shopify_api_secret = config('constant.shopify_api_secret');

        $this->user = new User();
    }

    public function index()
    {
        return view('oauth.index');
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $response = $this->redirectToInstallPage($request->shopname);
        // dd($response);
        return redirect($response);
    }

    public function redirectToInstallPage($shop_domain)
    {
        $params = [
            'client_id' => $this->shopify_api_key,
            'scope' => config('constant.shopify_scope'),
            'redirect_uri' => route('shopifyCallBack'),
        ];
        $installationUrl = 'https://' . $shop_domain . '/admin/oauth/authorize?' . http_build_query($params);
        return $installationUrl;
    }

    public function redirectUri(Request $request)
    {
        $latestAppVersion = config('constant.app_version');
        $this->shop = $request->get('shop');
        $hmac = $request->get('hmac');
        $requestParams = array_diff_key($request->all(), ['hmac' => '']);
        ksort($requestParams);

        $computedHmac = hash_hmac('sha256', http_build_query($requestParams), $this->shopify_api_secret);

        if (hash_equals($hmac, $computedHmac))
        {
            $getStore = $this->user->where('shop_domain', $this->shop)->latest()->first();
            // return $getStore;
            if ( !$getStore || is_null($getStore->password) || $getStore->password == '' )
            {
                $this->access_token = $this->getAccessToken($requestParams['code'], $this->shop);
            }
            else
            {
                $this->access_token = $getStore->password;
            }

            $storeData = [];
            if ($getStore)
            {
                $storeData['password'] = $this->access_token;
                $storeData['token'] = md5($this->access_token);

                if (!empty($getStore->uninstalled_at) || !is_null($getStore->uninstalled_at))
                {
                    $getStore->status = config('constant.user.status_code.active');
                    $getStore->uninstalled_at = null;
                }

                $getStore->password = $storeData['password'];
                $getStore->token = $storeData['token'];
                $getStore->total_install_count = $getStore->total_install_count + 1;
                $getStore->app_version = $latestAppVersion;
                $getStore->update();
                // return $getStore->password;

                $this->user->createWebhook($getStore);
                // $this->addScriptTag($this->shop, $this->access_token);
            }
            else
            {
                $response = User::makeApiCall('shop.json','get','shop', [], $this->access_token, $this->shop);

                if (!empty($response))
                {
                    $storeData = [
                        'shop_id' => $response['id'],
                        'name' => $response['name'],
                        'shop_domain' => $response['myshopify_domain'],
                        'domain' => $response['domain'],
                        'email' => $response['customer_email'],
                        'password' => $this->access_token,
                        'token' => md5($this->access_token),
                        'app_version' => $latestAppVersion,
                        'timezone' => $response['iana_timezone'],
                        'status' => config('constant.user.status_code.active'),
                        'total_install_count' => '1',
                    ];
                    $getStore = $this->user->create($storeData);

                    $this->user->createWebhook($getStore);
                    // $this->addScriptTag($this->shop, $this->access_token);
                }
                else
                {
                    Log::debug('Error in shop request.');
                }
            }
            return $this->getShopUrl($this->shop);
        }
        else
        {
            Log::debug('Shopify-callback: Invalid Hmac.');
        }
    }

    public function getShopUrl($appStoreUrl)
    {
        return redirect("https://".$appStoreUrl."/admin/apps/".$this->shopify_api_key."/");
    }

    public function getAccessToken($code = null, $shop = null)
    {
        if (is_null($code) || is_null($shop))
        {
            return false;
        }
        try
        {
            $response = Http::post("https://" . $shop . "/admin/oauth/access_token", [
                "client_id" => $this->shopify_api_key,
                "client_secret" => $this->shopify_api_secret,
                "code" => $code,
            ]);
            $responseJson = $response->json();
            if (!empty($responseJson) && isset($responseJson['access_token']))
            {
                return $responseJson['access_token'];
            }
            Log::debug(print_r($responseJson, true));
        }catch (Exception $e)
        {
            return null;
        }
    }

    public function addScriptTag($shop, $access_token)
    {
        $parameter = ['role' => 'main'];
        $getTheme = User::makeApiCall('themes.json','get','themes', $parameter, $access_token, $shop);

        // $url = "https://".$shop.config('constant.shopify_api_version')."/themes.json";
        // $getTheme = Http::withHeaders([
        //         'Accept'                    =>  'application/json',
        //         'Content-Type'              =>  'application/json',
        //         'X-Shopify-Access-Token'    =>  $access_token,
        //     ])->get($url,$parameter);


        $getAsset = User::makeApiCall('themes/'.$getTheme[0]['id'].'/assets.json?asset[key]=layout/theme.liquid','get','asset', [], $access_token, $shop);

        // $url = "https://".$shop.config('constant.shopify_api_version')."/themes/".$getTheme[0]['id']."/assets.json?asset[key]=layout/theme.liquid";
        // $getAsset = Http::withHeaders([
        //         'Accept'                    =>  'application/json',
        //         'Content-Type'              =>  'application/json',
        //         'X-Shopify-Access-Token'    =>  $access_token,
        //     ])->get($url);

        $url = URL::to('/public/assets/js/custom.js');
        $link = "<script src='$url'></script>\n";

        if (Str::contains($getAsset['value'], $link))
        {
        }
        else
        {
            $data = [
                "asset" => [
                    "key" => $getAsset['key'],
                    "value" => Str::of($getAsset['value'])->replace('</head>', $link.'</head>'),
                ]
            ];

            $updateAsset = User::makeApiCall('themes/'.$getTheme[0]['id'].'/assets.json','put','asset', $data, $access_token, $shop);

            // $url = "https://" . $shop . config('constant.shopify_api_version') . "/themes/". $getTheme[0]['id'] ."/assets.json";
            // $updateThemeAsset = Http::withHeaders([
            //     'Accept'                    =>  'application/json',
            //     'Content-Type'              =>  'application/json',
            //     'X-Shopify-Access-Token'    =>  $access_token
            // ])->put($url, $data);
        }
        return;
    }
}
