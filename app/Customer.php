<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function coupons()
    {
        return $this->hasMany(CouponRedeem::class);
    }

    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }
}
