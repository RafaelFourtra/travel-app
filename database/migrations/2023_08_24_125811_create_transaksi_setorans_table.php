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
        Schema::create('transaksi_setorans', function (Blueprint $table) {
            $table->id();
            $table->integer('kode_transaksi');
            $table->foreignId('jamaah_id')->references('id')->on('data_jamaahs');
            $table->foreignId('paket_id')->references('id')->on('pakets');
            $table->string('namajamaah');
            $table->integer('harga_paket');
            $table->integer('saldo');
            $table->tinyInteger('is_lunas');
            $table->string('keterangan')->nullable();
            $table->date('tanggal_transaksi');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_setorans');
    }
};
