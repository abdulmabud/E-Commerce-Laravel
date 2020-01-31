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

    public function checkout(){
        return view('frontend.checkout');
    }
}
