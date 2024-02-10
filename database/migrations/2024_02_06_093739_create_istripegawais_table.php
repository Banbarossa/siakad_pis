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
        Schema::create('istripegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained()->cascadeOnDelete();
            $table->string('status');
            $table->string('nama_istri');
            $table->string('nik_istri')->nullable();
            $table->string('tempat_lahir_istri')->nullable();
            $table->date('tanggal_lahir_istri')->nullable();
            $table->string('pendidikan_istri')->nullable();
            $table->string('pekerjaan_istri')->nullable();
            $table->timestamps();
        });

        // Status;
        // istri
        // suami
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('istripegawais');
    }
};
