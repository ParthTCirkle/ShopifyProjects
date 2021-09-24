<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Osiset\ShopifyApp\Contracts\ShopModel as IShopModel;
use Osiset\ShopifyApp\Traits\ShopModel;

class User extends Authenticatable implements IShopModel
{
    use HasApiTokens, HasFactory, Notifiable;
    use ShopModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // user has many products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // public function setPasswordAttribute($value)
    // {
    //     if ($value == null)
    //     {
    //         $this->attributes['password'] = $value;
    //     }
    //     else
    //     {
    //         $length = env('ADD_STRING_LENGTH');
    //         $positions = explode(",",env('POSITION'));
    //         info('original:'.$value);

    //         $value = Str::after($value, 'shpat_');
    //         foreach($positions as $position)
    //         {
    //             $randomString = substr(str_shuffle('abcdef0123456789'), 0, $length);
    //             $value = substr_replace( $value, $randomString, $position, 0 );
    //         }
    //         $value = 'shpat_'.$value;

    //         info('encrypted:'.$value);
    //         $this->attributes['password'] = $value;
    //     }
    // }

    // public function getPasswordAttribute($value)
    // {
    //     if ( $value == null )
    //     {
    //         return $value;
    //     }
    //     else
    //     {
    //         $length = env('ADD_STRING_LENGTH');
    //         $positions = explode( ",", env('POSITION') );
    //         $positions = array_reverse($positions);

    //         $value = Str::after($value, 'shpat_');
    //         foreach($positions as $position)
    //         {
    //             $value = substr_replace( $value, '', $position, $length );
    //         }
    //         $value = 'shpat_'.$value;

    //         info('decrypted : '.$value);
    //         return $value;
    //     }
    // }
}
