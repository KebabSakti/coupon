<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
