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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('no_po');
            $table->date('tanggal');
            $table->date('tanggal_kirim')->nullable();
            $table->decimal('total', 9, 3)->default(0);
            $table->decimal('ppn', 9, 3)->default(0);
            $table->decimal('grand_total', 9, 3)->default(0);
            $table->enum('status', ['INPUT', 'DITERIMA ADMIN GUDANG', 'DELIVERY ORDER', 'STOK KOSONG'])->default('INPUT');
            $table->boolean('is_selesai')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('logistik_id')->nullable();
            $table->unsignedBigInteger('gudang_id')->nullable();
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('logistik_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gudang_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
