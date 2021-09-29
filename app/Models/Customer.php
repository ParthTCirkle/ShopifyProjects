<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency', 'tags', 'phone', 'note', 'email', 'last_name', 'first_name', 'customer_id', 'user_id',
    ];
}
