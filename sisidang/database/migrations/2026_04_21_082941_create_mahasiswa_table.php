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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nim')->unique();
            $table->string('nama');
            $table->string('prodi');
            $table->year('angkatan');
            $table->text('judul_skripsi')->nullable();
            $table->foreignId('dosen_pembimbing_id')->nullable()->constrained('dosen')->onDelete('set null');
            $table->enum('status', ['aktif', 'daftar_sidang', 'sidang', 'lulus', 'tidak_lulus'])->default('aktif');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
