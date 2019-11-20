<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
}
