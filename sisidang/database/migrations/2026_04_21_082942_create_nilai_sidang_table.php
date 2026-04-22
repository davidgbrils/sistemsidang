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
        Schema::create('nilai_sidang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')->constrained('jadwal_sidang')->onDelete('cascade');
            $table->foreignId('dosen_id')->constrained('dosen')->onDelete('cascade');
            $table->decimal('komponen_presentasi', 5, 2);
            $table->decimal('komponen_penguasaan', 5, 2);
            $table->decimal('komponen_penulisan', 5, 2);
            $table->decimal('komponen_sikap', 5, 2);
            $table->decimal('total_nilai', 5, 2)->nullable();
            $table->string('grade')->nullable();
            $table->text('catatan_revisi')->nullable();
            $table->string('ttd_path')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_sidang');
    }
};
