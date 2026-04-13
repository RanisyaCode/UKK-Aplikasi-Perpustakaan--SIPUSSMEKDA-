<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('buku_id')->constrained('bukus')->onDelete('cascade');
            
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->dateTime('tgl_pengembalian_aktual')->nullable(); 
            
            // Menggunakan string agar fleksibel
            // Status: 'Menunggu Pinjam', 'Dipinjam', 'Menunggu Kembali', 'Selesai', 'Ditolak'
            $table->string('status')->default('Menunggu Pinjam'); 
            
            $table->text('catatan')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};