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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('nupl');
            $table->string('nama');
            $table->string('no_kk')->nullable();
            $table->string('no_nik')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('pendidikan_terakhir');
            $table->string('lulusan');
            $table->string('tmt');
            $table->string('jabatan')->nullable();
            $table->integer('type_pegawai')->nullable();
            $table->integer('status_nikah')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->foreignId('village_id')->nullable();
            $table->text('alamat')->nullable();
            $table->text('kode_pos')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // status_nikah
        // 1=>Belum Menikah,
        // 2=>Menikah Menikah,
        // 3=>Duda,
        // 4=>janda,

        // Type Pegawai
        // 1=>Guru Tetap
        // 2=>Guru Tidak tetap
        // 3=>Pegawai tetap
        // 4=>Pegawai Tidak tetap
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
