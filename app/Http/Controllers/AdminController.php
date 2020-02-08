<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function order(){
        $data['orders'] = Order::orderBy('id', 'desc')->get();
        return view('admin.order.order', $data);
    }

    public function orderDetails($id){
        $data['order'] = Order::find($id);
        // $orderId = $data['order']['id'];
        return view('admin.order.orderdetails', $data);
    }
}
