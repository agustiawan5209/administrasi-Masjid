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
        Schema::create('data_donaturs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donatur_id')->constrained('donaturs');
            $table->string('nama_donatur',100);
            $table->string('jenis',100);
            $table->string('jumlah',100);
            $table->string('bukti',100);
            $table->date('tanggal');
            $table->string('ket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_donaturs');
    }
};
