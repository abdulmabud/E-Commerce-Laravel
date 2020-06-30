<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use Auth;

class UserController extends Controller
{
    public function account(){
        $user_id = Auth::user()->id;
        $data['user'] = User::where('id', $user_id)->first();
        $data['orders'] = Order::where('user_id', $user_id)->orderBy('id', 'DESC')->get();
        return view('auth.user.myaccount', $data);
    }
}
