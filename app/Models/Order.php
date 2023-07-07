<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_po',
        'tanggal',
        'tanggal_kirim',
        'total',
        'ppn',
        'grand_total',
        'status',
        'is_selesai',
        'user_id',
        'logistik_id',
        'gudang_id'
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function logistikBy()
    {
        return $this->belongsTo(User::class, 'logistik_id');
    }

    public function gudangBy()
    {
        return $this->belongsTo(User::class, 'gudang_id');
    }
}
