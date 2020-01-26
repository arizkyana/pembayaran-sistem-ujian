<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        $user = Auth::user();
        
        // data
        $carts = Cart::where([
        'created_by' => $user->id
        ])->get();
        
        // summary
        $total = 0;
        foreach($carts as $cart){
            $total += $cart->itemPembayaran->harga;
        }
        
        return view('checkout.index', [
        'carts' => $carts,
        'total' => $total
        ]);
    }
}