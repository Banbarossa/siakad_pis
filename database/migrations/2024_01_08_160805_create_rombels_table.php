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
        Schema::create('rombels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_id')->constrained();
            $table->string('nama_rombel');
            $table->integer('tingkat_kelas');
            $table->foreignId('sekolah_id')->constrained()->cascadeOnDelete();
            $table->integer('absen_rombel_id')->nullable();
            $table->foreignId('guru_id')->constrained('gurus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rombels');
    }
};
