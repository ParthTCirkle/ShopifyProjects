<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'title',
        'description',
        'vendor',
        'type',
        'handle',
        'product_created_at',
        'product_updated_at',
        'status',
        'tags',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
