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
    Schema::create('attendees', function (Blueprint $table) {
        $table->id();
        // Foreign key yang menghubungkan ke tabel 'events'
        $table->foreignId('event_id')->constrained()->onDelete('cascade');
        $table->string('nama_lengkap');
        $table->string('email')->unique();
        $table->string('no_telepon');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendees');
    }
};
