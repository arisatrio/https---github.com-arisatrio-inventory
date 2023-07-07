<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukStok extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_tipe_id',
        'tanggal',
        'stok_masuk',
        'stok_keluar',
        'is_stok_masuk'
    ];

    // public static function boot()
    // {
    //     parent::boot();

    //     self::creating(function ($model) {
    //         $model->produkTipe->stok += $model->stok_masuk;
    //         $model->produkTipe->save();
    //     });

    //     self::updating(function ($model) {
    //         $model->produkTipe->update([
    //             'stok' => $model->produkTipe->stok()->sum('stok_masuk')
    //         ]);
    //     });
    // }

    public function produkTipe()
    {
        return $this->belongsTo(ProdukTipe::class);
    }
}
