<?php

namespace App\Http\Controllers;

use App\Cart;
use App\DetailPembayaran;
use App\Pembayaran;
use App\Repositories\PembayaranRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PembayaranController extends Controller
{
    private $pembayaranRepo;

    public function __construct(PembayaranRepo $pembayaranRepo)
    {
        $this->middleware('auth');

        $this->pembayaranRepo = $pembayaranRepo;
    }

    public function index(Request $request)
    {
        $this->authorize('pembayaran');

        $pembayaran = Pembayaran::limit(10)->orderBy('created_at', 'desc')->get();

        return view('pembayaran.index', [
            'pembayaran' => $pembayaran
        ]);
    }

    public function create(Request $request)
    {

        $list_cart = collect($request->post('carts'));

        // create pembayaran first
        $pembayaran = new Pembayaran();
        $pembayaran->no_kwitansi = Str::random(10);
        $pembayaran->created_by = $request->user()->id;
        $pembayaran->save();

        $list_cart->each(function ($item, $key) use ($pembayaran, $request) {
            $collection = collect([explode(",", $item)]);

            $collection->eachSpread(function ($id_cart, $harga) use ($pembayaran, $request) {

                // save to detail pembayaran
                $detail_pembayaran = new DetailPembayaran();
                $detail_pembayaran->id_cart = $id_cart;
                $detail_pembayaran->harga = $harga;
                $detail_pembayaran->id_pembayaran = $pembayaran->id;
                $detail_pembayaran->created_by = $request->user()->id;
                $detail_pembayaran->save();

                // remove cart
                $cart = Cart::find($id_cart);
                $cart->show = false;
                $cart->save();
            });
        });

        return redirect(route('checkout:upload', ['no_kwitansi' => $pembayaran->no_kwitansi]))->with([
            'status' => 'success',
            'message' => 'Anda telah berhasil melakukan pembayaran, silahkan konfirmasi pembayaran anda.'
        ]);
    }

    public function updateAll(Request $request)
    {
        $list_verify = collect($request->post('verified'));

        $list_verify->each(function ($item, $key) use ($request) {
            $pembayaran = Pembayaran::find($item);
            $pembayaran->is_paid = true;
            $pembayaran->save();
        });

        return redirect(route('pembayaran'))->with([
            'status' => 'success',
            'message' => 'Anda berhasil verifikasi pembayaran'
        ]);
    }
}
