<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = '/x';
    
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }
    
    public function index(){
        return view('auth.login');
    }
    
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)){
            return redirect()->intended('dashboard');
        }
        
        abort(403);
    }
    
    public function logout(Request $request){
        Auth::guard()->logout();
        
        $request->session()->invalidate();
        
        return redirect('/');
    }
}