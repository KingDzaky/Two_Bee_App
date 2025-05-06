<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orderans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggans')->onDelete('cascade');
            $table->foreignId('layanan_id')->nullable()->constrained('layanans')->onDelete('set null');
            $table->string('alamat');
            $table->string('telepon');
            $table->string('email')->nullable();
            $table->date('tanggal');
            $table->time('waktu');
            $table->integer('harga');
            $table->string('no_nota')->unique();
            $table->enum('status', ['Proses', 'Selesai', 'Diantar'])->default('Proses');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('orderans', function (Blueprint $table) {
            $table->dropForeign(['layanan_id']);
            $table->dropColumn('layanan_id');
        });
    }
};
