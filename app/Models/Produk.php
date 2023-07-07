<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'merk',
        'name',
        'description',
        'satuan',
    ];

    public function tipe()
    {
        return $this->hasMany(ProdukTipe::class);
    }
}
