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
        Schema::create('transaksi', function (Blueprint $table) {
            // Column Setup
            $table->unsignedBigInteger('id_transaksi', 8)->autoIncrement()->primary();
            $table->date('tanggal')->nullable(false);
            $table->unsignedBigInteger('total_transaksi', 10)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
