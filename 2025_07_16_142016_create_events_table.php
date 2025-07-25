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
    Schema::create('events', function (Blueprint $table) {
        $table->id(); // Kolom ID otomatis (primary key)
        $table->string('nama_acara'); // Kolom untuk nama acara
        $table->date('tanggal'); // Kolom untuk tanggal acara
        $table->string('lokasi'); // Kolom untuk lokasi acara
        $table->text('deskripsi')->nullable(); // Kolom deskripsi, boleh kosong
        $table->timestamps(); // Kolom created_at dan updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
