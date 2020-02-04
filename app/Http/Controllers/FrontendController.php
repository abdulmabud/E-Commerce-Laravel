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

        $product = Product::select('name', 'sale_price')->where('id', $productId)->first();
        $cart = $request->session()->get('cart');
        if($cart == null){
            $cart['products'][$productId] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->sale_price
            ];
        }
        if(array_key_exists($productId, $cart['products'])){
            $cart['products'][$productId]['quantity'] += 1;
        }else{
            $cart['products'][$productId] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->sale_price
            ];
        }

       $request->session()->put('cart', $cart);
    //    echo $cart['products'][4]['name']; 
    //    dd($cart);

    //    $data['products'] = $cart;
       return redirect()->route('cart.show')->with('success', 'Product added in cart Successfully');
     }

     public function showCart(Request $request){
        $cart = $request->session()->get('cart');
        if($cart == null){
            return view('frontend.cartnoitem');
        }else{
            return view('frontend.cart', $cart);
        }
         
     }

    public function checkout(Request $request){
        $cart = $request->session()->get('cart');
        return view('frontend.checkout', $cart);
    }
}
