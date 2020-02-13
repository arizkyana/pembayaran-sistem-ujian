<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Pembayaran;
use App\Semester;
use App\ItemPembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{

    public function list_pembayaran(Request $request)
    {
        $param = $request->query('semester');

        return ItemPembayaran::where('semester_id', $param)->get();
    }

    public function list_semester()
    {
        return Semester::all();
    }

    public function add_pembayaran(Request $request)
    {
        $user = $request->post('user');
        $id_item_pembayaran = $request->post('id');

        $cart_exist = Cart::where([
            'created_by' => $user,
            'id_item_pembayaran' => $id_item_pembayaran,
            'show' => true
        ])->first();

        if (empty($cart_exist)) {
            $cart = new Cart();
            $cart->id_item_pembayaran = $id_item_pembayaran;
            $cart->created_by = $user;
            $cart->show = true;
            $cart->save();
            return response()->json($cart, 201);
        }

        return response()->json(['message' => 'item sudah ditambahkan'], 400);

    }

    public function remove(Request $request, $id)
    {
        $pembayaran = Cart::find($id);
        $pembayaran->delete();

        return response()->json(['message' => 'berhasil hapus item'], 202);
    }
}
