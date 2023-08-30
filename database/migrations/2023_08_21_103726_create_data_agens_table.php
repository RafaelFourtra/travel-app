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
        Schema::create('data_agens', function (Blueprint $table) {
            $table->id();
            $table->string('nia');
            $table->string('namaagen');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->string('no_ktp');
            $table->string('no_passport');
            $table->string('no_hp');
            $table->string('tempat_lahir');
            $table->string('tgl_lahir');
            $table->string('keterangan');
            $table->string('jumlah_jamaah');
            $table->string('fee_jamaah');
            $table->string('jumlah_saldo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_agens');
    }
};
