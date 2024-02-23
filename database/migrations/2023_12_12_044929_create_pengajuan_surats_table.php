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
            $table->string('kode_unik');
            $table->integer('no_urut');
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('nomor_surat')->nullable();
            $table->string('jenis_surat');
            $table->text('keperluan');
            //
            $table->string('nama')->nullable();
            $table->string('ttl')->nullable();
            $table->string('nisp_nisn')->nullable();
            $table->string('kelas')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('tahun_pelajaran')->nullable();
            $table->string('nama_tt')->nullable();
            $table->string('nupl_tt')->nullable();
            //

            $table->foreignId('diajukan_oleh')->nullable()->constrained('users');
            $table->foreignId('disetujui_oleh')->nullable()->constrained('users');
            $table->dateTime('tanggal_disetujui')->nullable();
            $table->timestamps();
        });

        // Jenis Surat
        // 1=> Surat Aktif

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surats');
    }
};
