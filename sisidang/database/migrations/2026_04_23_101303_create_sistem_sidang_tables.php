<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nidn')->unique();
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->string('jurusan');
            $table->string('fakultas');
            $table->timestamps();
        });

        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('npm')->unique();
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->string('jurusan');
            $table->string('fakultas');
            $table->unsignedBigInteger('dosbing_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('dosbing_id')->references('id')->on('dosens')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('file_proposal')->nullable();
            $table->string('status')->default('pending');
            $table->date('tanggal_pengajuan');
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
        });

        Schema::create('sidangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('pengajuan_id');
            $table->dateTime('tanggal_sidang');
            $table->string('ruangan');
            $table->string('waktu');
            $table->string('status')->default('scheduled');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('pengajuan_id')->references('id')->on('pengajuans')->onDelete('cascade');
        });

        Schema::create('dosen_sidang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sidang_id');
            $table->unsignedBigInteger('dosen_id');
            $table->string('role');
            $table->timestamps();

            $table->foreign('sidang_id')->references('id')->on('sidangs')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('dosens')->onDelete('cascade');
        });

        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sidang_id');
            $table->unsignedBigInteger('dosen_id');
            $table->decimal('nilai_penyajian', 5, 2)->nullable();
            $table->decimal('nilai_penulisan', 5, 2)->nullable();
            $table->decimal('nilai_penguasaan', 5, 2)->nullable();
            $table->decimal('nilai_total', 5, 2)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('sidang_id')->references('id')->on('sidangs')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('dosens')->onDelete('cascade');
        });

        Schema::create('revisis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sidang_id');
            $table->text('catatan_revisi');
            $table->string('file_revisi')->nullable();
            $table->date('deadline');
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('sidang_id')->references('id')->on('sidangs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revisis');
        Schema::dropIfExists('nilais');
        Schema::dropIfExists('dosen_sidang');
        Schema::dropIfExists('sidangs');
        Schema::dropIfExists('pengajuans');
        Schema::dropIfExists('mahasiswas');
        Schema::dropIfExists('dosens');
    }
};