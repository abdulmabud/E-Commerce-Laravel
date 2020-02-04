<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use Validator;

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

    public function store(Request $request){
        $validator = Validator::make($request->all() ,[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'email',
            'address' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $orderObj = new Order;
        $orderObj->user_name = $request->name;
        $orderObj->user_phone = $request->phone;
        $orderObj->user_email = $request->email;
        $orderObj->address = $request->address;
        $orderObj->subtotal = $request->subtotal;
        $orderObj->delivery_charge = $request->delivery_charge;
        $orderObj->total_price = $request->total_price;

        $orderObj->save();

        return redirect()->route('homepage')->with('success', 'Order Place Successfully');
        
    }
}
