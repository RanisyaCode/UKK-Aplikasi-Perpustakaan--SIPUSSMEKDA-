<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Pastikan nama tabel benar
    protected $table = 'transaksis';

    // WAJIB: Daftarkan semua kolom yang kamu isi di Controller
    protected $fillable = [
        'user_id', 
        'buku_id', 
        'tanggal_pinjam', 
        'tanggal_kembali', 
        'tgl_pengembalian_aktual', 
        'status', 
        'catatan'
    ];

    /**
     * Fitur Casting: Mengubah string dari DB menjadi objek Carbon secara otomatis.
     * Ini akan memperbaiki error "format() on string" di Blade.
     */
    protected $casts = [
        'tanggal_pinjam' => 'datetime',
        'tanggal_kembali' => 'datetime',
        'tgl_pengembalian_aktual' => 'datetime',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}