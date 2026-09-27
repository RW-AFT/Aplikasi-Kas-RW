<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik')->unique();
            $table->string('rt');
            $table->string('rw');
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->timestamps();
        });

        Schema::create('iurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('wargas')->onDelete('cascade');
            $table->string('bulan');
            $table->year('tahun');
            $table->bigInteger('jumlah')->default(0);
            $table->enum('status', ['lunas', 'belum'])->default('belum');
            $table->date('tanggal_bayar')->nullable();
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->nullable()->constrained('wargas')->onDelete('set null');
            $table->enum('jenis', ['pemasukan', 'pengeluaran']);
            $table->string('kategori');
            $table->text('keterangan')->nullable();
            $table->bigInteger('jumlah');
            $table->date('tanggal');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('iurans');
        Schema::dropIfExists('wargas');
    }
};
