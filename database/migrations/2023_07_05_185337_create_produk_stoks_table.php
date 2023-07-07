<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk_stoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_tipe_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal');
            $table->integer('stok_masuk')->nullable();
            $table->integer('stok_keluar')->nullable();
            $table->boolean('is_stok_masuk')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_stoks');
    }
};
