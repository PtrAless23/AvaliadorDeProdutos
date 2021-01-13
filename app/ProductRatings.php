<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class ProductRatings extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['product_name'];

    public function product() {
        return $this->belongsTo('App\Product');
    }

    public function getProductNameAttribute() {
        return $this->product->name;
    }
}
