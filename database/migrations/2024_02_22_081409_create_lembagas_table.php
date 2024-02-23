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
        Schema::create('lembagas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lembaga');
            $table->string('nama_pimpinan');
            $table->string('nip_pimpinan')->nullable();
            $table->foreignId('village_id')->nullable();
            $table->string('logo')->nullable();
            $table->string('kop')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembagas');
    }
};
