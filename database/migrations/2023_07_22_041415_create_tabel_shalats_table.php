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
        Schema::create('tabel_shalats', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['shalat_wajib','jumat','khusus']);
            $table->date('tanggal');
            $table->enum('hari', ['senin','selasa','rabu','kamis','jumat','sabtu','minggu']);
            $table->string('waktu',50)->nullable();
            $table->time('jam')->nullable();

            // Jika Shalat Jumat
            $table->string('muadzin',50)->nullable();
            $table->string('khotbah',50)->nullable();
            $table->string('imam',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_shalats');
    }
};
