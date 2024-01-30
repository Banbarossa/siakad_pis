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
        Schema::create('pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->date('tanggal')->nullable();
            $table->time('jam')->nullable();
            $table->string('level_pelanggaran')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('penanganan')->nullable();
            $table->integer('point')->nullable();
            $table->boolean('is_show')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggarans');
    }
};
