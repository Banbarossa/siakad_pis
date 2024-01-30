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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nisn')->nullable();
            $table->string('nis_sekolah')->nullable();
            $table->string('nis_pesantren')->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->date('tahun_masuk')->nullable();
            $table->string('status_sosial')->nullable();
            $table->string('status_rumah')->nullable();
            $table->boolean('is_asrama')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('nomor_yatim')->nullable();
            $table->string('nomor_wali')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('hubungan_keluarga')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->integer('dari_jumlah_saudara')->nullable();
            $table->integer('jumlah_saudara_laki_laki')->nullable();
            $table->integer('jumlah_saudara_perempuan')->nullable();
            $table->string('nomor_registrasi_akte_lahir')->nullable();
            $table->string('hobi')->nullable();
            $table->string('cita_cita')->nullable();
            $table->integer('tinggi_badan')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->string('alamat')->nullable();
            $table->foreignId('village_id')->nullable();
            $table->string('kode_pos')->nullable();

            $table->string('status_siswa')->nullable();
            $table->boolean('is_aktif')->nullable();
            $table->timestamps();
        });
    }

    //status_siswa
    // ['aktif','lulus','pindah','calon santri']

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
