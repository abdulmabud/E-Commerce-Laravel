<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class FrontendController extends Controller
{
    public function index(){
        $data['products'] = Product::where('status', 1)->get();
        return view('frontend.index', $data);
    }

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

    public function checkout(){
        return view('frontend.checkout');
    }
}
