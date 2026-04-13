<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerpustakaanSiswaController extends Controller
{
    public function index()
    {
        // Mengambil semua buku, atau bisa pakai latest() agar yang baru diinput Admin muncul paling atas
        $daftarBuku = Buku::latest()->get(); 
        $user = Auth::user();

        return view('siswa.dashboard', compact('daftarBuku', 'user'));
    }

    /**
     * Menampilkan Detail Buku (Jika diklik)
     */
    public function detailBuku($id)
    {
        $buku = Buku::findOrFail($id);
        return view('siswa.detail-buku', compact('buku'));
    }

    public function formPinjam($buku_id)
    {
        $buku = Buku::findOrFail($buku_id);
        
        // Jika stok habis, kembalikan dengan pesan error
        if ($buku->stok <= 0) {
            return redirect()->back()->with('error', 'Maaf, stok buku ini sedang habis.');
        }

        return view('siswa.pilih-buku', compact('buku'));
    }
}