<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPembayaran extends Model
{
    protected $table = 'detail_pembayaran';
    protected $primaryKey = 'id';

    public function cart()
    {
        return $this->belongsTo('App\Cart', 'id_cart', 'id');
    }
}
