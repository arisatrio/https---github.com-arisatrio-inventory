<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukTipe extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'produk_id',
        'name',
        'ukuran',
        'harga',
        'stok'
    ];

    public function stok(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $this->stokMasuk->sum('stok_masuk') - $this->stokKeluar->sum('stok_keluar'),
            set: fn ($value) => $value,
        );
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function stoks()
    {
        return $this->hasMany(ProdukStok::class);
    }

    public function stokMasuk()
    {
        return $this->stoks()->where('is_stok_masuk', 1);
    }

    public function stokKeluar()
    {
        return $this->stoks()->where('is_stok_masuk', 0);
    }
}
