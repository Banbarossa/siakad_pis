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
        Schema::create('pengajuan_surats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_surat');
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('nomor_surat')->nullable();
            $table->string('jenis_surat');
            $table->dateTime('tanggal_pengajuan');
            $table->text('keperluan');
            $table->foreignId('diajukan_oleh')->nullable()->constrained('users');
            $table->foreignId('disetujui_oleh')->nullable()->constrained('users');
            $table->dateTime('tanggal_disetujui')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surats');
    }
};
