<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aset_pc', function (Blueprint $table) {
            $table->id();
            $table->string('kode_aset', 30)->unique();
            $table->string('nama_perangkat', 120);
            $table->string('jenis', 20);
            $table->string('merek', 80);
            $table->text('spesifikasi')->nullable();
            $table->foreignId('departemen_id')->constrained('departemen')->restrictOnDelete();
            $table->string('kondisi', 30);
            $table->string('status', 30);
            $table->date('tanggal_pembelian')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aset_pc');
    }
};
