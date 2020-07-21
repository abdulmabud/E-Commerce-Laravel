<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Validator;

class SettingController extends Controller
{
    public function index(){
        $data['delivery_charge'] = Setting::select('meta_value')->where('meta_key', 'Delivery Charge')->first();
        if(!$data['delivery_charge']){
            $data['zero_delivery_charge'] = 0;
        }
        return view('admin.setting.index', $data);
    }

    public function dCharge(Request $request){
        $validator = Validator::make($request->all(),[
            'charge' => 'required'
        ]);
        if($validator->fails()){
            return false;
        }
        $dObj = Setting::where('meta_key', 'Delivery Charge')->first();
        if($dObj){
            $dObj->meta_value = $request->charge;
            $dObj->save();
        }else{
            $dObj = new Setting();
            $dObj->meta_key = 'Delivery Charge';
            $dObj->meta_value = $request->charge;
            $dObj->remarks = 'null';
            $dObj->save();
        }
        

    }
}
