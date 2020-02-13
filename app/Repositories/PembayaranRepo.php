<?php

namespace App\Repositories;


use App\Pembayaran;

class PembayaranRepo
{
    private $pembayaran;

    public function __construct(Pembayaran $pembayaran)
    {
        $this->pembayaran = $pembayaran;
    }

    public function getByNoKwitansi($no_kwitansi)
    {
        $pembayaran = $this->pembayaran->where('no_kwitansi', $no_kwitansi)->first();
        return $pembayaran;
    }
}
