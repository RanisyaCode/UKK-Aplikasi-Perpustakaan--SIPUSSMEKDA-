<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Statistik Utama
        $count_user = User::count();
        $count_buku = Buku::count();
        $count_pinjam = Transaksi::where('status', 'Dipinjam')->count();
        $count_overdue = Transaksi::where('status', 'Dipinjam')
                            ->where('tanggal_kembali', '<', now())
                            ->count();

        // 2. Log Aktivitas Terbaru
        $recent_transactions = Transaksi::with(['user', 'buku'])
                                ->latest()
                                ->take(6)
                                ->get();

        // 3. Hitung Persentase untuk Circular Progress
        $persen_pinjam = $count_buku > 0 ? round(($count_pinjam / $count_buku) * 100) : 0;

        // 4. Definisi Title
        $title1 = 'Dashboard Admin';
        $title2 = 'Ringkasan Statistik';

        // Kirim semua ke view
        return view('dashboardadmin', compact(
            'count_user', 
            'count_buku', 
            'count_pinjam', 
            'count_overdue', 
            'recent_transactions', 
            'persen_pinjam',
            'title1',
            'title2'
        ));
    }
}