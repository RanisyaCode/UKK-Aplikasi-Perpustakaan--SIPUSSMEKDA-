<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPUS SMEKDA || Daftar Akun</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('duralux/assets/images/logo/logo open book perpus.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('duralux/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('duralux/assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        // Script pencegah kedipan (Flash of Unstyled Content)
        (function() {
            const savedTheme = localStorage.getItem('sipus-theme') || 'dark';
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>

    <style>
        /* --- DYNAMIC THEME VARIABLES --- */
        :root {
            /* Default Dark Mode */
            --bg-body: #020617;
            --bg-sidebar: #0f172a;
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --input-bg: rgba(255, 255, 255, 0.04);
            --emerald: #10b981;
            --ocean: #0ea5e9;
            --gradasi: linear-gradient(135deg, #10b981 0%, #0ea5e9 100%);
            --garis: rgba(255, 255, 255, 0.08);
        }

        /* Light Mode Overrides */
        [data-theme="light"] {
            --bg-body: #f8fafc;
            --bg-sidebar: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --input-bg: #f1f5f9;
            --garis: rgba(0, 0, 0, 0.08);
        }

        body, html {
            margin: 0;
            padding: 0;
            height: auto !important;
            min-height: 100vh;
            background-color: var(--bg-body);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            font-size: 13px;
            overflow-x: hidden;
            overflow-y: auto !important;
            transition: background-color 0.3s ease;
        }

        .auth-cover-wrapper { display: flex; min-height: 100vh; width: 100%; }

        /* --- SISI KIRI --- */
        .auth-cover-content-inner {
            flex: 1;
            background: radial-gradient(circle at center, var(--bg-sidebar) 0%, var(--bg-body) 100%) !important;
            display: flex !important;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            transition: background 0.3s ease;
        }

        .auth-img img { max-width: 260px; filter: drop-shadow(0 0 15px rgba(16, 185, 129, 0.2)); }
        .visual-text h1 { font-size: 1.6rem; font-weight: 800; margin-top: 15px; color: var(--text-main); }
        .visual-text p { font-size: 0.85rem; color: var(--text-muted); }

        /* --- SISI KANAN --- */
        .auth-cover-sidebar-inner {
            flex: 0 0 480px; 
            background: var(--bg-sidebar) !important;
            border-left: 1px solid var(--garis);
            padding: 30px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: background 0.3s ease;
            overflow-y: auto; /* Pastikan bisa scroll jika form panjang */
        }

        .auth-cover-card { width: 100%; padding: 0 40px; }

        h2 { font-size: 1.25rem !important; font-weight: 700 !important; margin-bottom: 2px; color: var(--text-main); }
        
        .form-label { 
            color: var(--text-muted); 
            font-size: 10.5px !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
            margin-bottom: 4px;
        }
        
        .form-control, .form-select {
            background-color: var(--input-bg) !important;
            border: 1px solid var(--garis) !important;
            color: var(--text-main) !important;
            padding: 7px 12px;
            font-size: 12px !important;
            height: 38px;
            width: 100%; /* Mencegah select luber ke samping */
        }

        .form-select option {
            background-color: var(--bg-sidebar) !important;
            color: var(--text-main) !important;
            font-size: 12px !important;
            padding: 10px;
        }

        .btn-primary { 
            background: var(--gradasi) !important; 
            border: none !important; 
            width: 100% !important;
            padding: 10px !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            margin-top: 8px;
            letter-spacing: 1px;
            color: #fff !important;
        }

        .text-white.fw-bold { color: var(--text-main) !important; }

        .particle {
            position: absolute;
            background: var(--emerald);
            border-radius: 50%;
            opacity: 0.25;
            z-index: 1;
            pointer-events: none;
            animation: fly linear infinite;
        }

        @keyframes fly {
            from { transform: translateY(110vh); opacity: 0; }
            50% { opacity: 0.3; }
            to { transform: translateY(-10vh); opacity: 0; }
        }

        @media (max-width: 991px) {
            .auth-cover-content-inner { display: none !important; }
            .auth-cover-sidebar-inner { flex: 1; width: 100%; border-left: none; }
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .spinner-loading {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 0.8s linear infinite;
            margin-right: 8px;
            vertical-align: middle;
        }
        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #ff4d4d !important;
        }

        /* --- TAMBAHAN PERBAIKAN RESPONSIVE (TANPA MENGUBAH KODE DI ATAS) --- */
        @media (max-width: 576px) {
            .auth-cover-card {
                padding: 0 20px; /* Kurangi padding samping agar tidak terlalu sempit */
            }
            .auth-cover-sidebar-inner {
                padding: 20px 0;
            }
            h2 {
                font-size: 1.15rem !important;
            }
            /* Ubah baris ganda (NIS, JK, Sandi) menjadi satu kolom di layar kecil */
            .row.g-2 > div {
                width: 100% !important;
                margin-bottom: 4px;
            }
            .mb-2 {
                margin-bottom: 15px !important;
            }
        }

        /* Perbaikan untuk landscape HP atau layar pendek */
        @media (max-height: 700px) {
            .auth-cover-sidebar-inner {
                display: block; 
                padding-top: 40px;
            }
        }
    </style>
</head>

<body>
    <main class="auth-cover-wrapper">
        <div class="auth-cover-content-inner d-none d-lg-flex" id="particles-box">
            <div class="auth-img"><img src="{{ asset('duralux/assets/images/auth/auth-cover-register-bg1.svg') }}" alt="Visual"></div>
            <div class="visual-text text-center px-4" style="z-index: 10; position: relative;">
                <h1>Mulai Perjalanan <span style="color: var(--emerald);">Ilmumu.</span></h1>
                <p>Jelajahi ribuan buku dalam satu sistem digital terintegrasi.</p>
            </div>
        </div>

        <div class="auth-cover-sidebar-inner">
            <div class="auth-cover-card">
                <div class="mb-3 text-center text-sm-start">
                    <img src="{{ asset('duralux/assets/images/logo/logo open book perpus.png') }}" alt="Logo" width="35" class="mb-2">
                    <h2>Daftar Akun <span style="color: var(--emerald);">SMEKDA</span></h2>
                    <p class="text-muted" style="font-size: 10.5px;">Gunakan data siswa yang valid untuk pendaftaran.</p>
                </div>

                <form action="{{ route('registerProses') }}" method="POST" novalidate>
                    @csrf
                    
                    <div class="mb-2">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama Lengkap Siswa" required>
                        @error('nama') <div style="color: #ff4d4d; font-size: 9px; margin-top: 3px; font-weight: 600;">* {{ $message }}</div> @enderror
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label">NIS</label>
                            <input type="number" name="nis" class="form-control @error('nis') is-invalid @enderror" value="{{ old('nis') }}" placeholder="9 Digit NIS" required>
                            @error('nis') <div style="color: #ff4d4d; font-size: 9px; margin-top: 3px; font-weight: 600;">* {{ $message }}</div> @enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih...</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <div style="color: #ff4d4d; font-size: 9px; margin-top: 3px; font-weight: 600;">* {{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label">Email Aktif</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="email@siswa.id" required>
                            @error('email') <div style="color: #ff4d4d; font-size: 9px; margin-top: 3px; font-weight: 600;">* {{ $message }}</div> @enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label">WhatsApp</label>
                            <input type="number" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" value="{{ old('no_telepon') }}" placeholder="08..." required>
                            @error('no_telepon') <div style="color: #ff4d4d; font-size: 9px; margin-top: 3px; font-weight: 600;">* {{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Kelas / Jurusan</label>
                        <select name="kelas" class="form-select @error('kelas') is-invalid @enderror" required>
                            <option value="" disabled selected hidden>--Pilih Kelas--</option>
                            @php
                                $kelasOptions = ['X PPLG 1', 'X PPLG 2', 'X TJKT 1', 'X TJKT 2', 'X MPLB 1', 'X MPLB 2', 'X PMS 1', 'X PMS 2', 'X PMS 3', 'X BS 1', 'X BS 2', 'X BS 3', 'X AKL 1', 'X AKL 2', 'X AKL 3', 'XI RPL 1', 'XI RPL 2', 'XI TKJ 1', 'XI TKJ 2', 'XI MP 1', 'XI MP 2', 'XI BR 1', 'XI BR 2', 'XI BD 1', 'XI DPB 1', 'XI DPB 2', 'XI DPB 3', 'XI AK 1', 'XI AK 2', 'XII RPL 1', 'XII RPL 2', 'XII TKJ 1', 'XII TKJ 2', 'XII MP 1', 'XII MP 2', 'XII BR 1', 'XII BR 2', 'XII BD 1', 'XII DPB 1', 'XII DPB 2', 'XII DPB 3', 'XII AK 1', 'XII AK 2', 'XII AK 3'];
                            @endphp
                            @foreach($kelasOptions as $item)
                                <option value="{{ $item }}" {{ old('kelas') == $item ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('kelas') <div style="color: #ff4d4d; font-size: 9px; margin-top: 3px; font-weight: 600;">* {{ $message }}</div> @enderror
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label">Sandi</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Min. 8 Karakter" required>
                            @error('password') <div style="color: #ff4d4d; font-size: 9px; margin-top: 3px; font-weight: 600;">* {{ $message }}</div> @enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label">Ulangi</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" id="btn-submit">DAFTAR SEKARANG</button>

                    <div class="text-center mt-3">
                        <p style="font-size: 11px;" class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-decoration-none" style="color: var(--text-main);">Masuk di sini</a></p>
                        <a href="{{ route('welcome') }}" style="font-size: 10px;" class="text-muted text-decoration-none"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById('particles-box');
            if (container) {
                for (let i = 0; i < 20; i++) {
                    const p = document.createElement('div');
                    p.className = 'particle';
                    const size = Math.random() * 3 + 2 + 'px';
                    p.style.width = size; p.style.height = size;
                    p.style.left = Math.random() * 100 + '%';
                    p.style.animationDuration = (Math.random() * 8 + 7) + 's';
                    p.style.animationDelay = (Math.random() * 5) + 's';
                    container.appendChild(p);
                }
            }
        });

        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('btn-submit');
            btn.disabled = true;
            btn.innerHTML = `<span class="spinner-loading"></span> MEMPROSES...`;
            btn.style.opacity = '0.8';
        });
    </script>
</body>
</html>