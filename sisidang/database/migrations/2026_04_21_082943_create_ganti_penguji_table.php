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
        Schema::create('ganti_penguji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')->constrained('jadwal_sidang')->onDelete('cascade');
            $table->foreignId('penguji_lama_id')->constrained('dosen')->onDelete('cascade');
            $table->foreignId('penguji_baru_id')->constrained('dosen')->onDelete('cascade');
            $table->text('alasan');
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
            $table->text('alasan_penolakan')->nullable();
            $table->foreignId('requested_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('requested_at');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ganti_penguji');
    }
};
