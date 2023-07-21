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
        Schema::create('saldo_dompets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('saldo_masuk')->nullable();
            $table->bigInteger('saldo_keluar')->nullable();
            $table->bigInteger('total_saldo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_dompets');
    }
};
