<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{
    protected $hidden = ['created_at', 'updated_at'];

    public function ratings() {
        return $this->hasMany('App\ProductRatings');
    }

    public function getActiveAttribute($value) {
        return $value == true;
    }
}
