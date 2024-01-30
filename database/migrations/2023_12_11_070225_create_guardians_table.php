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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('nik', 16);
            $table->string('nama');
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('penghasilan')->nullable();
            $table->string('status')->nullable();
            $table->string('contact')->nullable();
            $table->string('alamat')->nullable();
            $table->foreignId('village_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('regency_id')->nullable();
            $table->foreignId('province_id')->nullable();
            $table->string('kode_pos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
