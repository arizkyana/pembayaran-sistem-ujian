<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;

class LoginController extends Controller
{
    
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }
    
    public function index(){
        return view('auth.login');
    }
    
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        
        $validator = Validator::make($request->all(), [
        'email' => 'required',
        'password' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect(route('login'))
            ->withErrors($validator)
            ->withInput();
        }
        
        
        if (Auth::attempt($credentials)){
            return redirect()->intended('dashboard');
        }
        
        return redirect(route('login'))->with('message', 'email dan password anda salah');
    }
    
    public function logout(Request $request){
        Auth::guard()->logout();
        
        $request->session()->invalidate();
        
        return redirect('/');
    }
}