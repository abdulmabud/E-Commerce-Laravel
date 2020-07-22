<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Validator;
use Image;

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

    public function updateSlider(){
        $data['slider_images'] = Setting::select('id', 'meta_value')->where('meta_key', 'slider_image')->get();
        return view('admin.setting.updateslider', $data);
    }

    public function storeSlider(Request $request){
        $validator = Validator::make($request->all(),[
            'slider' => 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->hasFile('slider')){
            $image = $request->file('slider');
            $name = time().'.'.$image->getClientOriginalExtension();
            // $path = public_path('upload/slider');
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(1200, 350);
            $image_resize->save(public_path('upload/slider/' .$name));
            // $image->move($path, $name);
            $settingObj = new Setting();
            $settingObj->meta_key = 'slider_image';
            $settingObj->meta_value = $name;
            $settingObj->remarks = 'Homepage Slider Image';
            $settingObj->save();
            return redirect()->route('slider.update')->with('success', 'Slider Added Successfully');
        }
    }

    public function destroySlider($id){
        Setting::find($id)->delete();
        return redirect()->route('slider.update')->with('success', 'Slider Deleted Successfully');
    }
}
