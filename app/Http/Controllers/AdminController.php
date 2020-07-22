<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('isadmin');
    }
    
    public function index(){
        return view('admin.dashboard');
    }

    public function order(){
        $data['orders'] = Order::orderBy('id', 'desc')->get();
        return view('admin.order.order', $data);
    }

    public function orderDetails($id){
        $data['order'] = Order::find($id);
        $data['orders'] = OrderItem::where('order_id', $id)->get();
      
        return view('admin.order.orderdetails', $data);
    }
}
