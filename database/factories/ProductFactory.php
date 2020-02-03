<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Product;


$factory->define(Product::class, function (Faker $faker) {
    return [
        
            'name' => $faker->name,
            'regular_price' => random_int(50, 1000),
            'sale_price' => random_int(50, 1000),
            'category_id' => random_int(1, 5),
            'status' => 1

    ];
});
