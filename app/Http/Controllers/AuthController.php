<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registerForm(){
        if(Auth::check()){
            return redirect()->route('homepage');
        }
        return view('auth.register');
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:1000'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'address' => $request['address'],
            'password' => Hash::make($request['password']),
        ]);

        if($user){
            return redirect()->route('login')->with('success', 'Registraion Successfullly');
        }
    }

    public function loginForm(){
        if(Auth::check()){
            return redirect()->route('homepage');
        }
        return view('auth.login');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('myaccount');
            }
        }else{
            return redirect()->route('login')
                ->with('warning','Email-Address And Password Are Wrong.');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout Successfully');
    }
}
