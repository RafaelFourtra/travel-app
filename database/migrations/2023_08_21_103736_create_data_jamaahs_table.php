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
        Schema::create('data_jamaahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('nij');
            $table->string('namajamaah');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->string('no_ktp');
            $table->string('no_passport');
            $table->string('no_hp');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('keterangan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_jamaahs');
    }
};
