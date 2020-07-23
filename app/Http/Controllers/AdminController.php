<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use App\OrderStatus;
use App\Contact;
use Validator;

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
        $data['order'] = Order::with('orderstatuses')->find($id);
        $data['orders'] = OrderItem::where('order_id', $id)->get();
        return view('admin.order.orderdetails', $data);
    }

    public function changeStatus(Request $request){
        $validator = Validator::make($request->all(),[
            'order_id' => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()){
            return 'failed';
        }
        $statusObj = new OrderStatus();
        $statusObj->order_id = $request->order_id;
        $statusObj->status = $request->status;
        $statusObj->save();
        return 'success';
    }

    public function contact(){
        $data['contacts'] = Contact::select('id', 'name', 'subject')->orderBy('id', 'DESC')->get();
        return view('admin.contact.index', $data);
    }

    public function contactDetails($id){
        $data['contact'] = Contact::find($id);
        return view('admin.contact.contactdetails', $data);
    }
}
