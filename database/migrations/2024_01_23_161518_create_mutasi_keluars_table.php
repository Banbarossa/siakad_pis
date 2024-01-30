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
        Schema::create('mutasi_keluars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('sebab_keluar');
            $table->date('tanggal_mutasi');
            $table->longText('alasan_pindah')->nullable();
            $table->string('sekolah_lanjutan')->nullable();
            $table->string('npsn')->nullable();
            $table->timestamps();

            // Mutasi
            // Dikeluarkan
            // Mengundurkan Diri
            // Putus Sekolah
            // Wafat
            // Hilang
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_keluars');
    }
};
