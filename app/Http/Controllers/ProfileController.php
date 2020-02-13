<?php

namespace App\Http\Controllers;

use App\DetailPembayaran;
use App\Pembayaran;
use App\Repositories\PembayaranRepo;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $pembayaranRepo;

    public function __construct(PembayaranRepo $pembayaranRepo)
    {
        $this->middleware('auth');

        $this->pembayaranRepo = $pembayaranRepo;
    }

    public function history_pembayaran(Request $request)
    {
        $this->authorize('profile');

        $pembayaran = Pembayaran::where('created_by', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('profile.index', [
            'pembayaran' => $pembayaran
        ]);
    }

    public function detail_pembayaran(Request $request, $no_kwitansi)
    {
        $this->authorize('profile');

        $pembayaran = $this->pembayaranRepo->getByNoKwitansi($no_kwitansi);

        $total = 0;
        foreach ($pembayaran->detail as $detail) {
            $total += $detail->cart->itemPembayaran->harga;
        }

        return view('profile.detail', [
            'pembayaran' => $pembayaran,
            'total' => $total
        ]);

    }
}
