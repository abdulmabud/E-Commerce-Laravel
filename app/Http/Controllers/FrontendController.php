<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\OrderItem;
use Validator;

class FrontendController extends Controller
{
    public function index(){
        $data['products'] = Product::where('status', 1)->get();
        return view('frontend.index', $data);
    }

    public function productDetail($productId){
        $data['product'] = Product::find($productId)->first();

        return view('frontend.productdetails', $data);
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
        }else{
            if(array_key_exists($productId, $cart['products'])){
                $cart['products'][$productId]['quantity'] += 1;
            }else{
                $cart['products'][$productId] = [
                    'name' => $product->name,
                    'quantity' => 1,
                    'price' => $product->sale_price
                ];
            }
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
        $lastOrderId = Order::select('id')->orderBy('id', 'desc')->first();
        if($lastOrderId == null){
            $lastOrderId = 1;
        }else{
            $lastOrderId = $lastOrderId->id + 1;
        }
        
        $orderObj = new Order;
        $orderObj->user_name = $request->name;
        $orderObj->user_phone = $request->phone;
        $orderObj->user_email = $request->email;
        $orderObj->address = $request->address;
        $orderObj->subtotal = $request->subtotal;
        $orderObj->delivery_charge = $request->delivery_charge;
        $orderObj->total_price = $request->total_price;

        $cart = $request->session()->get('cart');

        $orderObj->save();

        if($cart != null){
           
            $products = $cart['products'];
            foreach($products as $product){
                $orderItem = new OrderItem;
                $orderItem->order_id = $lastOrderId;
                $orderItem->product_name = $product['name'];
                $orderItem->unit_price = $product['price'];
                $orderItem->quantity = $product['quantity'];
                $orderItem->save();
            }
        }
        $request->session()->forget('cart');
        return redirect()->route('homepage')->with('success', 'Order Place Successfully');
        
    }
}
