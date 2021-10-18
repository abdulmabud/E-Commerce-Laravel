<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderitems(){
        return $this->hasMany('App\Models\OrderItem');
    }

    public function orderstatuses(){
        return $this->hasMany('App\Models\OrderStatus'); 
    }

}
