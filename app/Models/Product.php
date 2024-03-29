<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function productimages(){
        return $this->hasMany('App\Models\ProductImage');
    }
}
