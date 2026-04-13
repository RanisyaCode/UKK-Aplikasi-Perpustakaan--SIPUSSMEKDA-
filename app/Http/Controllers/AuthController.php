<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthController extends Controller
{
    // =========================
    // REGISTER
    // =========================
    public function register()
    {
        return view('auth.register');
    }

    public function registerProses(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'min:3', 'max:50'],
            'nis'  => ['required', 'numeric', 'digits:9', 'unique:users,nis'], // Wajib 9 digit angka
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'email' => ['required', 'email', 'unique:users,email'],
            'no_telepon' => ['required', 'numeric', 'digits_between:10,15'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'kelas' => ['required', 'string', 'max:20'],
        ], [
            'nama.required'      => 'Nama tidak boleh kosong',
            'nis.digits'         => 'NIS harus berjumlah 9 angka',
            'nis.required'       => 'NIS wajib diisi',
            'nis.unique'         => 'NIS sudah terdaftar',
            'nis.numeric'        => 'NIS harus berupa angka',
            'jenis_kelamin.required' => 'Pilih jenis kelamin',
            'email.required'      => 'Email wajib diisi',
            'email.unique'       => 'Email sudah terdaftar',
            'no_telepon.required'   => 'Nomor telepon wajib diisi',
            'no_telepon.numeric'    => 'Nomor telepon harus angka',
            'no_telepon.digits_between' => 'Nomor telepon harus antara 10 hingga 15 digit',
            'password.required' => 'Password wajib diisi',
            'password.min'      => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'kelas.required'     => 'Kelas harus diisi',
        ]);

        // Simpan data user baru
        $user = User::create([
            'nama'          => trim($request->nama),
            'nis'           => $request->nis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email'         => strtolower($request->email),
            'no_telepon'    => $request->no_telepon,
            'password'      => bcrypt($request->password),
            'role'          => 'Siswa',
            'kelas'         => $request->kelas,
            'aksi'          => true,
            'theme'         => 'dark', // Tambahkan ini sebagai default awal
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat!');
    }

    public function login() { 
        return view('auth.login');
    }

    public function process(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required'    => 'Email tidak boleh kosong',
            'email.email'       => 'Format email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.min'      => 'Password minimal 8 karakter',
        ]);

        // 2. Ambil kredensial
        $credentials = $request->only('email', 'password');

        // 3. Cek remember me
        $remember = $request->boolean('remember');

        // 4. Proses login
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // LOGIKA REDIRECT BERDASARKAN ROLE
            if ($user->role == 'Admin') {
                return redirect()->route('dashboardadmin')->with('success', 'Selamat Datang Admin!');
            } else {
                return redirect()->route('dashboard')->with('success', 'Anda berhasil login');
            }
        }

        // 7. Login gagal
        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password salah');
    }

    public function updateTheme(Request $request)
    {
        // Validasi input
        $request->validate([
            'theme' => 'required|in:light,dark'
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->theme = $request->theme;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Tema berhasil diperbarui menjadi ' . $request->theme
        ]);
    }

}