<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Jobs\CreateShopifyWebhook;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'shop_id',
        'name',
        'shop_domain',
        'domain',
        'email',
        'password',
        'token',
        'app_version',
        'timezone',
        'status',
        'total_install_count',
        'uninstalled_at',
    ];

    protected $hidden = [
        'password',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'uninstalled_at'
    ];

    public static function makeApiCall($requestApiUrl, $method, $requestKey, $requestData = [], $accessToken = null, $shopDomain = null)
    {
        // dump($requestApiUrl, $method, $requestKey, $requestData, $accessToken, $shopDomain);
        $url = "https://" . $shopDomain . config('constant.shopify_api_version') . "/" . $requestApiUrl;
        // dump($url);
        $apiResponse = Http::withHeaders([
                'Accept'                    =>  'application/json',
                'Content-Type'              =>  'application/json',
                'X-Shopify-Access-Token'    =>  $accessToken,
            ])->$method($url, $requestData);
        // dump($apiResponse->json());
        // dd($apiResponse[$requestKey]);
        if ($method == 'delete')
        {
            return $apiResponse;
        }
        return $apiResponse[$requestKey];
    }

    public static function createWebhook($store, $request = null)
    {
        CreateShopifyWebhook::dispatch($request, $store);
    }

    // user has many products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // user has one charge
    public function charge()
    {
        return $this->hasOne(Charge::class);
    }

    public function setPasswordAttribute($value)
    {
        if ($value == null)
        {
            $this->attributes['password'] = $value;
        }
        else
        {
            $length = env('ADD_STRING_LENGTH');
            $positions = explode(",",env('POSITION'));
            info('original:'.$value);

            $value = Str::after($value, 'shpat_');
            foreach($positions as $position)
            {
                $randomString = substr(str_shuffle('abcdef0123456789'), 0, $length);
                $value = substr_replace( $value, $randomString, $position, 0 );
            }
            $value = 'shpat_'.$value;

            info('encrypted:'.$value);
            $this->attributes['password'] = $value;
        }
    }

    public function getPasswordAttribute($value)
    {
        if ( $value == null )
        {
            return $value;
        }
        else
        {
            $length = env('ADD_STRING_LENGTH');
            $positions = explode( ",", env('POSITION') );
            $positions = array_reverse($positions);

            $value = Str::after($value, 'shpat_');
            foreach($positions as $position)
            {
                $value = substr_replace( $value, '', $position, $length );
            }
            $value = 'shpat_'.$value;

            info('decrypted : '.$value);
            return $value;
        }
    }
}
