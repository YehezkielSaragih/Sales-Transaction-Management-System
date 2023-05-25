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
        // Fix timestamp
        // Schema::table('kategori', function (Blueprint $table) {
        //     $table->timestamps();
        // });
        // DB::table('kategori')->update([
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        
        Schema::create('kategori', function (Blueprint $table) {
            // Column Setup
            $table->unsignedBigInteger('id_kategori', 8)->autoIncrement()->primary();
            $table->string('nama_kategori', 100)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};
