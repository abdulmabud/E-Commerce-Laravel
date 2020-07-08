<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\OrderItem;
use Auth;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function account(){
        $user_id = Auth::user()->id;
        $data['user'] = User::where('id', $user_id)->first();
        $data['orders'] = Order::where('user_id', $user_id)->orderBy('id', 'DESC')->get();
        return view('auth.user.myaccount', $data);
    }

    public function orderdetails(Request $request){
        $order_id = $request->id;
        $data['order'] = Order::find($order_id)->first();
        $user_id = Auth::user()->id;
        if($data['order']['user_id'] != $user_id){
            abort(404);
        }           

        $data['orders'] = OrderItem::select('product_name', 'unit_price', 'quantity')->where('order_id', $order_id)->get();
        return view('auth.user.orderdetails', $data);
    }
}
