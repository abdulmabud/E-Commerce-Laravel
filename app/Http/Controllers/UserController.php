<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function cartAdd(Request $request, $productId){

        $cart = $request->session()->get('cart');
        if(array_key_exists($productId, $cart['products'])){
            $cart['products'][$productId]['quantity'] += 1;
        }else{
            $cart['products'][$productId] = [
                'name' => 'New Product',
                'quantity' => 1,
                'price' => 34
            ];
        }

       $request->session()->put('cart', $cart);
        
    }

    public function showCart(Request $request){
        $output = $request->session()->get('cart');
        dd($output);
    }
}
