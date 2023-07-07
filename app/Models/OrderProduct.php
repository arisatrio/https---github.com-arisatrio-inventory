<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'produk_tipe_id',
        'harga',
        'qty',
        'sub_total'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function produkTipe()
    {
        return $this->belongsTo(ProdukTipe::class);
    }
}
