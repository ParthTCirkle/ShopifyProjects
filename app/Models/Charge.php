<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = [
        'charge_id',
        'user_id',
        'plan_id',
        'name',
        'price',
        'trial_days',
        'status',
        'test',
        'billing_on',
        'activated_on',
        'cancelled_on',
        'trial_ends_on',
    ];

    // charge belongs to one plan
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    // charge belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
