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
        // // Fix timestamp
        // Schema::table('barang', function (Blueprint $table) {
        //     $table->timestamps();
        // });
        // DB::table('barang')->update([
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        Schema::create('barang', function (Blueprint $table) {
            // Column Setup
            $table->unsignedBigInteger('id_barang', 8)->autoIncrement()->primary();
            $table->unsignedBigInteger('id_kategori', 8)->nullable(false);
            $table->string('nama_barang', 100)->unique()->nullable(false);
            $table->unsignedBigInteger('harga_barang', 10)->nullable(false);
            $table->timestamps();
            // Table relation
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
