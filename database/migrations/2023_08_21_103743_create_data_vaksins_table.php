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
        Schema::create('data_vaksins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jamaah_id')->references('id')->on('data_jamaahs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('vaksin');
            $table->date('tanggal');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_vaksins');
    }
};
