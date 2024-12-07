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
        Schema::create('item_lists', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('harga');
            $table->string('detail_info');
            // $table->string('tipe_parkiran')->constrained('Garasi', 'Lahan', 'Parkiran');
            $table->string('ukuran');
            $table->string('deskripsi');
            $table->foreignId('id_province')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreignId('id_regency')->references('id')->on('regencies')->onDelete('cascade');
            $table->string('lokasi');
            $table->foreignId('id_owner')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_lists');
    }
};