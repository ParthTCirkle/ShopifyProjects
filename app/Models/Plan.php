<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'price',
        'interval',
        'capped_amount',
        'terms',
        'trial_days',
        'test',
        'on_install'
    ];

    public function charges()
    {
        return $this->hasMany(Charge::class);
    }
}
