<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPUS SMEKDA || Login</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('duralux/assets/images/logo/logo open book perpus.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('duralux/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script>
        // IIFE untuk mencegah flash warna putih saat loading
        (function() {
            const savedTheme = localStorage.getItem('sipus-theme') || 'dark';
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>

    <style>
        :root {
            /* Default Dark Mode */
            --bg-body: #020617;
            --bg-form: rgba(15, 23, 42, 0.98);
            --emerald: #10b981;
            --ocean: #0ea5e9;
            --gradasi: linear-gradient(135deg, #10b981 0%, #0ea5e9 100%);
            --garis: rgba(255, 255, 255, 0.08);
            --teks-utama: #ffffff;
            --teks-muted: #94a3b8;
            --input-bg: rgba(255, 255, 255, 0.05);
        }

        /* Light Mode Overrides */
        [data-theme="light"] {
            --bg-body: #f8fafc;
            --bg-form: #ffffff;
            --garis: rgba(0, 0, 0, 0.08);
            --teks-utama: #0f172a;
            --teks-muted: #64748b;
            --input-bg: #f1f5f9;
        }

        /* Reset Dasar - KUNCI SCROLL */
        body, html {
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100%;
            background-color: var(--bg-body);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--teks-utama);
            overflow: hidden;
            transition: background-color 0.3s ease;
        }

        /* Main Wrapper */
        .auth-container {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* Sisi Kiri - Visual */
        .auth-visual {
            flex: 1;
            background: radial-gradient(circle at center, var(--input-bg) 0%, var(--bg-body) 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
            position: relative;
        }

        /* Sisi Kanan - Form */
        .auth-form-side {
            width: 400px;
            background: var(--bg-form);
            border-left: 1px solid var(--garis);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            flex-shrink: 0;
            transition: background-color 0.3s ease;
        }

        .auth-card {
            width: 100%;
            max-width: 300px;
        }

        /* Ilustrasi */
        .img-illustration {
            max-width: 50%;
            height: auto;
            margin-bottom: 20px;
            filter: drop-shadow(0 0 30px rgba(14, 165, 233, 0.2));
        }

        /* Typography */
        .brand-logo { width: 50px; margin-bottom: 15px; }
        h1.fw-800 { font-size: 1.5rem !important; color: var(--teks-utama); }
        h2 { font-weight: 800; font-size: 1.3rem !important; margin-bottom: 5px; color: var(--teks-utama); }
        h2 span { 
            background: var(--gradasi); 
            -webkit-background-clip: text; 
            background-clip: text; /* Tambahan properti standar */
            -webkit-text-fill-color: transparent; 
        }
        .subtitle { color: var(--teks-muted); font-size: 0.75rem; margin-bottom: 25px; }

        /* Input Styling */
        .form-label { font-size: 0.75rem; font-weight: 600; color: var(--teks-utama); margin-bottom: 5px; opacity: 0.8; }
        .form-control {
            background: var(--input-bg) !important;
            border: 1px solid var(--garis) !important;
            border-radius: 8px !important;
            color: var(--teks-utama) !important;
            padding: 8px 12px !important;
            font-size: 0.85rem;
        }
        
        .password-wrapper { position: relative; }
        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--teks-muted);
            z-index: 10;
            font-size: 1rem;
        }

        /* Button */
        .btn-masuk {
            background: var(--gradasi);
            border: none;
            border-radius: 8px;
            padding: 10px;
            color: #fff !important;
            font-weight: 800;
            width: 100%;
            margin-top: 5px;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        /* Partikel */
        .partikel {
            position: absolute; background: var(--emerald);
            border-radius: 2px; opacity: 0.1;
            animation: terbang 20s infinite linear;
        }
        @keyframes terbang {
            from { transform: translateY(110vh) rotate(0deg); }
            to { transform: translateY(-10vh) rotate(360deg); }
        }

        /* Link colors adjustment for light mode */
        .auth-card a.text-white {
            color: var(--teks-utama) !important;
        }

        /* Responsive */
        @media (max-width: 991px) {
            body { overflow-y: auto; }
            .auth-visual { display: none; }
            .auth-form-side { width: 100%; border: none; }
        }

        .form-control.is-invalid {
            border-color: #ff4d4d !important;
            background-image: none !important; /* Menghilangkan ikon tanda seru bawaan bootstrap jika mengganggu */
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
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-visual" id="particles-container">
            <img src="{{ asset('duralux/assets/images/auth/auth-cover-login-bg.svg') }}" class="img-illustration" alt="SIPUS">
            <h1 class="fw-800 text-center">
                Satu Akun, 
                <span style="background: var(--gradasi); background-clip: text; -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    Sejuta Ilmu.
                </span>
            </h1>
            <p class="text-center" style="max-width: 350px; font-size: 0.8rem; color: var(--teks-muted);">Masuk ke ekosistem perpustakaan digital SMKN 2 dan mulai eksplorasi karyamu hari ini.</p>
        </div>

        <div class="auth-form-side">
            <div class="auth-card">
                <div class="text-center">
                    <img src="{{ asset('duralux/assets/images/logo/logo open book perpus.png') }}" class="brand-logo" alt="Logo">
                    <h2>Masuk <span>SMEKDA</span></h2>
                    <p class="subtitle">Gunakan kredensial akun Anda.</p>
                </div>

                <form action="{{ route('login.process') }}" method="POST" novalidate>
                    @csrf

                    {{-- Alert untuk Pesan Error Login (Kombinasi Email/PW Salah) --}}
                    @if(session('error'))
                        <div style="color: #ff4d4d; font-size: 0.75rem; margin-bottom: 15px; padding: 10px; background: rgba(255, 77, 77, 0.1); border-radius: 8px; border: 1px solid rgba(255, 77, 77, 0.2);">
                            <i class="bi bi-exclamation-circle me-1"></i> {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" name="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            placeholder="nama@gmail.com" 
                            value="{{ old('email') }}" required>
                        
                        {{-- Pesan Merah Kecil Untuk Email --}}
                        @error('email')
                            <div style="color: #ff4d4d; font-size: 0.7rem; margin-top: 4px; font-weight: 600;">
                                * {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label class="form-label">Kata Sandi</label>
                        </div>
                        <div class="password-wrapper">
                            <input type="password" name="password" id="password-input" 
                                class="form-control @error('password') is-invalid @enderror" 
                                placeholder="••••••••" required>
                            <i class="bi bi-eye toggle-password" id="eye-icon"></i>
                        </div>

                        {{-- Pesan Merah Kecil Untuk Password --}}
                        @error('password')
                            <div style="color: #ff4d4d; font-size: 0.7rem; margin-top: 4px; font-weight: 600;">
                                * {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label small" for="remember" style="font-size: 0.7rem; color: var(--teks-muted);">Ingat saya di perangkat ini</label>
                    </div>
                    <button type="submit" class="btn-masuk" id="btn-submit">MASUK SEKARANG</button>
                </form>
    
                <div class="text-center mt-3">
                    <p class="small" style="font-size: 0.75rem; color: var(--teks-muted);">Belum punya akun? <a href="{{ route('register') }}" class="fw-bold text-decoration-none" style="color: var(--teks-utama);">Daftar</a></p>
                    <div style="margin: 15px 0; color: var(--teks-muted); display: flex; align-items: center; font-size: 0.6rem; font-weight: 800; text-transform: uppercase;">
                        <span style="flex: 1; height: 1px; background: var(--garis); margin-right: 10px;"></span>
                        ATAU
                        <span style="flex: 1; height: 1px; background: var(--garis); margin-left: 10px;"></span>
                    </div>
                    <a href="{{ route('welcome') }}" class="text-decoration-none small fw-bold" style="font-size: 0.75rem; color: var(--teks-muted);">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fitur Mata Password
        const passwordInput = document.getElementById('password-input');
        const eyeIcon = document.getElementById('eye-icon');

        eyeIcon.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });

        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('btn-submit');
            
            // Nonaktifkan tombol agar tidak diklik dua kali
            btn.disabled = true;
            
            // Ubah tampilan tombol menjadi loading
            btn.innerHTML = `<span class="spinner-loading"></span> MEMPROSES...`;
            
            // Berikan sedikit gaya transparan agar terlihat sedang proses
            btn.style.opacity = '0.8';
            btn.style.cursor = 'not-allowed';
        });

        // Partikel
        const container = document.getElementById('particles-container');
        for (let i = 0; i < 20; i++) {
            const p = document.createElement('div');
            p.className = 'partikel';
            p.style.left = Math.random() * 100 + '%';
            p.style.width = p.style.height = Math.random() * 5 + 2 + 'px';
            p.style.animationDuration = Math.random() * 10 + 10 + 's';
            p.style.animationDelay = Math.random() * 5 + 's';
            container.appendChild(p);
        }
    </script>
</body>
</html>