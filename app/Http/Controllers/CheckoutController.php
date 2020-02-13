<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request)
    {
        $this->authorize('checkout');
        $user = Auth::user();

        // data
        $carts = Cart::where([
            'created_by' => $user->id,
            'show' => true
        ])
            ->orderBy('created_at', 'desc')
            ->get();

        // summary
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->itemPembayaran->harga;
        }

        return view('checkout.index', [
            'carts' => $carts,
            'total' => $total
        ]);
    }

    public function uploadForm(Request $request, $no_kwitansi)
    {
        $this->authorize('checkout');
        return view('checkout.upload', [
            'no_kwitansi' => $no_kwitansi
        ]);
    }

    public function upload(Request $request, $no_kwitansi)
    {
        $this->authorize('checkout');
        $file = $request->file('pembayaran');

        $path = $file->storeAs(
            "public/pembayaran/{$no_kwitansi}", Str::random(10) . Carbon::now()->format('ddmmyyyyhhmmss') . $this->parseExtension($file->getMimeType())
        );

        $pembayaran = Pembayaran::where('no_kwitansi', $no_kwitansi)->first();
        $pembayaran->bukti_pembayaran = $path;
        $pembayaran->save();

        return redirect(route('checkout:upload', ['no_kwitansi' => $no_kwitansi]))->with([
            'status' => 'success',
            'message' => 'Terima kasih anda telah mengkonfirmasi pembayaran. Pembayaran anda akan segera kami proses.'
        ]);
    }

    public function download(Request $request, $no_kwitansi)
    {
        $this->authorize('checkout');
        $pembayaran = Pembayaran::where('no_kwitansi', $no_kwitansi)->first();

        return response()->download(storage_path("app/{$pembayaran->bukti_pembayaran}"));

    }

    // TODO: buat menjadi utils
    private function parseExtension($mimeType)
    {
        if ($mimeType === 'image/png') return '.png';
        if ($mimeType === 'image/jpg') return '.jpg';
        if ($mimeType === 'image/jpeg') return '.jpeg';
    }
}
