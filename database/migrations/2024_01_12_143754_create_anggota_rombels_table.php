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
        Schema::create('anggota_rombels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_id')->constrained('semesters');
            $table->foreignId('student_id')->constrained();
            $table->foreignId('rombel_id')->constrained();
            $table->enum('pendaftaran', ['1', '2', '3', '4', '5']);
            $table->timestamps();
        });

        // Pendaftaran
        // 1 = Siswa Baru
        // 2 = Pindahan
        // 3 = Naik Kelas
        // 4 = Lanjutan Semester
        // 5 = Mengulang
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_rombels');
    }
};
