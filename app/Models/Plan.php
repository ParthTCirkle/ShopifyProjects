<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'primary',
        'plan_name',
        'price',
        'trial_days',
        'test',
        'capped_amout',
        'terms',
        'description'
    ];

    // plan has many charges
    public function charges()
    {
        return $this->hasMany(Charge::class);
    }
}
