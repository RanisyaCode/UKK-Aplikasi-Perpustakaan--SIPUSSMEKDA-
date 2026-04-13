<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'bukus';

    // Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'judul', 
        'penulis', 
        'kategori', 
        'isbn', 
        'penerbit', 
        'tahun_terbit', 
        'stok', 
        'jumlah_halaman',
        'cover',
        'sinopsis' 
    ];

    /**
     * Relasi ke Transaksi (Jika nanti dibutuhkan)
     * Satu buku bisa dipinjam berkali-kali dalam banyak transaksi
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'buku_id');
    }
}