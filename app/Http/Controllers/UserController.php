<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function cartAdd(Request $request, $productId){

        $cart = $request->session()->get('cart');
        if($cart == null){
            $cart['products'][$productId] = [
                'name' => 'New Product',
                'quantity' => 1,
                'price' => 34
            ];
        }
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
    //    echo $cart['products'][4]['name']; 
    //    dd($cart);

    //    $data['products'] = $cart;
       return view('frontend.cart', $cart);
     }

    public function showCart(Request $request){
        $output = $request->session()->get('cart');
        dd($output);
    }
}
