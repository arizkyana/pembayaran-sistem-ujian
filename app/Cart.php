<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";
    protected $primaryKey = "id";
    
    public function itemPembayaran(){
        return $this->belongsTo('App\ItemPembayaran', 'id_item_pembayaran');
    }
}