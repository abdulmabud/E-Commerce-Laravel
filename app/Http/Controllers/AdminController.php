<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // public function __construct(){
    //     $this->middleware('isadmin');
    // }
    
    public function index(){
        $data['pending'] = OrderStatus::where(['status'=>'Pending', 'active_now'=>1])->count();
        $data['accepted'] = OrderStatus::where(['status'=>'Accepted', 'active_now'=>1])->count();
        $data['assigned'] = OrderStatus::where(['status'=>'Assigned', 'active_now'=>1])->count();
        $data['delivered'] = OrderStatus::where(['status'=>'Delivered', 'active_now'=>1])->count();
        $data['canceled'] = OrderStatus::where(['status'=>'Canceled', 'active_now'=>1])->count();
        return view('admin.dashboard', $data);
    }

    public function order(){
        $data['orders'] = Order::with('orderstatuses')->get();
        // dd($data['orders']);
        return view('admin.order.order', $data);
    }

    public function orderFilter(Request $request){
        $status = $request->filterby;
        if($status != 'All'){
            $data['orders'] = OrderStatus::with('order')->where([
                'status' => $status,
                'active_now' => 1
            ])->orderBy('id', 'DESC')->get();
        }else{
            $data['orders'] = OrderStatus::with('order')->where('active_now', 1)->orderBy('id', 'DESC')->get();
        }
        return view('admin.inc.content.orderfilter', $data);
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

        $order_id = $request->order_id;

        OrderStatus::where('order_id', $order_id)->update(['active_now' => 0]);
       
        $statusObj = new OrderStatus();
        $statusObj->order_id = $order_id;
        $statusObj->status = $request->status;
        $statusObj->save();
        return 'success';
    }

    public function contact(){
        $data['contacts'] = Contact::select('id', 'name', 'subject', 'created_at')->orderBy('id', 'DESC')->get();
        return view('admin.contact.index', $data);
    }

    public function contactDetails($id){
        $data['contact'] = Contact::find($id);
        return view('admin.contact.contactdetails', $data);
    }
}
