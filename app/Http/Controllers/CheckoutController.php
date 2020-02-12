<?php

namespace App\Http\Controllers;

use App\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function uploadForm(Request $request){
        return view('checkout.upload');
    }

    public function upload(Request $request){
        $file = $request->file('pembayaran');

        $path = $file->storeAs(
            'public/pembayaran', Str::random(10) . Carbon::now()->format('ddmmyyyyhhmmss') . $this->parseExtension($file->getMimeType())
        );
        dd($path);
        return [
            'data' => $request->post(),
            'file-bukti' => $path
        ];
    }

    // TODO: buat menjadi utils
    private function parseExtension($mimeType) {
        if ($mimeType === 'image/png') return '.png';
        if ($mimeType === 'image/jpg') return '.jpg';
        if ($mimeType === 'image/jpeg') return '.jpeg';
    }
}
