<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id';

    public function detail()
    {
        return $this->hasMany('App\DetailPembayaran', 'id_pembayaran', 'id');
    }
}
