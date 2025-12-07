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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('id_users','11');
            $table->string('id_rekening','11');
            $table->dateTime('tanggal_pesanan');
            $table->text('pesanan');
            $table->string('nama_penerima');
            $table->string('lokasi_antar');
            $table->string('total_bayar');
            $table->string('bukti_pembayaran');
            $table->enum('status_pesanan', ['diproses', 'ditolak', 'diterima'])->default('diproses');
            $table->timestamps();
        });
        Schema::drop('personal_access_tokens');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
        
    }
};
