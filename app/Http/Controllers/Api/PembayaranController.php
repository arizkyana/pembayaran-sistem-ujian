<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Semester;
use App\ItemPembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    
    
    public function list_pembayaran(Request $request){
        $param = $request->query('semester');
        
        return  ItemPembayaran::where('semester_id' , $param)->get();
    }
    
    public function list_semester(){
        return Semester::all();
    }
    
    public function add_pembayaran(Request $request){
        $user = $request->post('user');
        $id_item_pembayaran = $request->post('id');
        
        $cart = new Cart();
        $cart->id_item_pembayaran = $id_item_pembayaran;
        $cart->created_by = $user;
        
        $cart->save();
        
        return $cart;
        
    }
}