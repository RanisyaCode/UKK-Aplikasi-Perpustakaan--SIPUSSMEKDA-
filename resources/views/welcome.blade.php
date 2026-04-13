<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>SIPUS SMEKDA || Homepage</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('duralux/assets/images/logo/logo open book perpus.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            /* Theme Variables */
            --bg-body: #020617;
            --bg-nav: rgba(2, 6, 23, 0.8);
            --teks-utama: #f1f5f9;
            --teks-muted: #94a3b8;
            --kaca: rgba(255, 255, 255, 0.03);
            --garis: rgba(255, 255, 255, 0.08);
            
            /* Branding Colors */
            --emerald: #10b981;
            --ocean: #0ea5e9;
            --gradasi: linear-gradient(135deg, #10b981 0%, #0ea5e9 100%);
        }

        [data-theme="light"] {
            --bg-body: #f8fafc;
            --bg-nav: rgba(248, 250, 252, 0.9);
            --teks-utama: #0f172a;
            --teks-muted: #64748b;
            --kaca: rgba(15, 23, 42, 0.05);
            --garis: rgba(15, 23, 42, 0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--teks-utama);
            overflow-x: hidden;
            transition: background-color 0.4s ease, color 0.4s ease;
        }

        .latar-animasi {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1; 
            background: radial-gradient(circle at 50% 50%, var(--bg-body) 0%, var(--bg-body) 100%);
            transition: background 0.4s ease;
        }
        [data-theme="dark"] .latar-animasi {
            background: radial-gradient(circle at 50% 50%, #0f172a 0%, #020617 100%);
        }
        
        .partikel {
            position: absolute; background: var(--emerald);
            border-radius: 2px; opacity: 0.2;
            animation: terbang 20s infinite linear;
        }
        @keyframes terbang {
            from { transform: translateY(100vh) rotate(0deg); opacity: 0.2; }
            to { transform: translateY(-10vh) rotate(360deg); opacity: 0; }
        }

        /* --- NAVBAR --- */
        .nav-utama {
            position: fixed; top: 0; width: 100%; height: 90px;
            background: var(--bg-nav); backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--garis);
            padding: 0 6%; display: flex; align-items: center; justify-content: space-between; 
            z-index: 1050;
            transition: all 0.4s ease;
        }
        .logo-smekda { font-weight: 800; font-size: 1.6rem; color: var(--teks-utama); text-decoration: none; letter-spacing: -1px; z-index: 1100; }
        .logo-smekda span { color: var(--emerald); }

        .menu-nav a {
            color: var(--teks-muted); text-decoration: none; font-weight: 600; font-size: 0.9rem;
            margin-right: 30px; transition: 0.3s; position: relative; padding-bottom: 5px;
        }
        .menu-nav a:hover, .menu-nav a.active { color: var(--teks-utama); }
        .menu-nav a.active::after {
            content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 2px;
            background: var(--gradasi); border-radius: 10px;
        }

        /* Group Toggle & Hamburger */
        .nav-controls {
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 1100;
        }

        #hamburger-menu {
            background: var(--kaca); border: 1px solid var(--garis); color: var(--teks-utama); 
            width: 42px; height: 42px; border-radius: 12px;
            display: none; cursor: pointer; align-items: center; justify-content: center; font-size: 1.5rem;
        }

        #theme-toggle {
            background: var(--kaca);
            border: 1px solid var(--garis);
            color: var(--teks-utama);
            width: 42px; height: 42px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: 0.3s;
        }
        #theme-toggle:hover { transform: scale(1.1); background: var(--garis); }

        /* --- HERO --- */
        .hero-section {
            min-height: 100vh; display: flex; align-items: center; padding: 120px 6% 60px;
            position: relative;
        }
        .hero-img-perpus {
            position: absolute; right: 0; top: 0; width: 55%; height: 100%;
            background: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=2000') center/cover;
            mask-image: linear-gradient(to left, black 30%, transparent 100%);
            -webkit-mask-image: linear-gradient(to left, black 30%, transparent 100%);
            opacity: 0.25; z-index: 1; animation: zoomSoft 20s infinite alternate ease-in-out;
        }
        [data-theme="light"] .hero-img-perpus { opacity: 0.1; }
        @keyframes zoomSoft { from { transform: scale(1); } to { transform: scale(1.1); } }

        .hero-teks { position: relative; z-index: 10; width: 60%; }
        .hero-teks h1 { font-size: clamp(2.5rem, 6vw, 4.5rem); font-weight: 800; line-height: 1.1; margin-bottom: 25px; color: var(--teks-utama); }
        .hero-teks h1 span { 
            background: var(--gradasi); 
            -webkit-background-clip: text; 
            background-clip: text;         
            -webkit-text-fill-color: transparent; 
        }
        .hero-sub { color: var(--teks-muted); max-width: 550px; }

        .btn-mewah {
            background: var(--gradasi); color: white !important; padding: 16px 40px;
            border-radius: 14px; text-decoration: none; font-weight: 800;
            display: inline-block; transition: 0.4s; border: none;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.2);
            text-align: center;
        }
        .btn-mewah:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4); }

        .search-box {
            background: var(--kaca); border: 1px solid var(--garis);
            border-radius: 18px; padding: 8px 8px 8px 20px;
            display: flex; align-items: center; max-width: 500px; margin-top: 30px;
        }
        .search-box input {
            background: transparent; border: none; color: var(--teks-utama); width: 100%; outline: none;
        }

        .grid-buku { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 30px; padding: 50px 0; }
        .kartu-buku { text-decoration: none; color: inherit; display: block; position: relative; cursor: pointer; }
        .sampul {
            border-radius: 22px; overflow: hidden; aspect-ratio: 2/3; margin-bottom: 15px;
            border: 1px solid var(--garis); transition: 0.6s cubic-bezier(0.2, 1, 0.2, 1);
            position: relative; background: var(--kaca);
        }
        .sampul img { width: 100%; height: 100%; object-fit: cover; }
        
        .modal-content {
            background: var(--bg-body); color: var(--teks-utama); border: 1px solid var(--garis); border-radius: 28px; overflow: hidden;
        }
        
        .stat-item {
            background: var(--kaca); border: 1px solid var(--garis);
            padding: 30px; border-radius: 20px; text-align: center;
            transition: 0.3s;
        }
        .stat-number { font-size: 2.5rem; font-weight: 800; background: var(--gradasi); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }

        .maps-container {
            border-radius: 25px; overflow: hidden; border: 1px solid var(--garis); height: 400px; width: 100%;
        }
        [data-theme="dark"] .maps-container iframe { filter: invert(90%) hue-rotate(180deg) brightness(95%) contrast(90%); }

        .fab-whatsapp {
            position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; background: #25d366;
            color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; z-index: 1000;
        }

        .footer-final { background: var(--bg-body); border-top: 1px solid var(--garis); padding: 80px 6% 40px; }
        .footer-links a { color: var(--teks-muted); text-decoration: none; transition: 0.3s; font-size: 0.95rem; display: block; margin-bottom: 10px; }
        .footer-links a:hover { color: var(--emerald); transform: translateX(8px); }
        
        @media (max-width: 991px) {
            #hamburger-menu { display: flex; }
            
            .menu-nav {
                display: none !important;
                flex-direction: column;
                position: fixed;
                top: 0; left: 0; width: 100%; height: 100vh;
                background: var(--bg-body);
                justify-content: center; align-items: center;
                z-index: 1090; gap: 2rem; opacity: 0; transform: translateY(-20px); transition: all 0.4s ease;
            }

            .menu-nav.active { display: flex !important; opacity: 1; transform: translateY(0); }
            .menu-nav a { margin: 0; font-size: 1.5rem; }
            
            .nav-actions-mobile { display: flex !important; flex-direction: column; align-items: center; gap: 1.5rem; width: 100%; margin-top: 1rem; }

            .hero-teks { width: 100%; text-align: center; }
            .hero-img-perpus { width: 100%; opacity: 0.15; }
        }
    </style>
</head>
<body>

    <div class="latar-animasi" id="particles-container"></div>
    <a href="https://wa.me/628123456789" class="fab-whatsapp" target="_blank"><i class="bi bi-whatsapp"></i></a>

    <nav class="nav-utama">
        <a href="#" class="logo-smekda">SIPUS<span>SMEKDA</span></a>
        
        <div class="menu-nav d-none d-lg-flex" id="nav-links">
            <a href="#beranda" class="nav-link-custom">Beranda</a>
            <a href="#katalog" class="nav-link-custom">Koleksi</a>
            <a href="#cara-pinjam" class="nav-link-custom">Alur</a>
            <a href="#lokasi" class="nav-link-custom">Lokasi</a>
            <a href="#bantuan" class="nav-link-custom">Bantuan</a>

            <div class="nav-actions-mobile d-lg-none">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn fw-bold" style="color: var(--teks-utama);">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn fw-bold" style="color: var(--teks-utama);">Login</a>
                    <a href="{{ route('register') }}" class="btn-mewah py-2 px-4">Daftar</a>
                @endauth
            </div>
        </div>

        <div class="nav-controls">
            <button id="theme-toggle" title="Ganti Tema">
                <i class="bi bi-moon-stars-fill" id="theme-icon"></i>
            </button>

            <div class="d-none d-lg-flex align-items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn fw-bold" style="color: var(--teks-utama);">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn fw-bold" style="color: var(--teks-utama);">Login</a>
                    <a href="{{ route('register') }}" class="btn-mewah py-2 px-4" style="font-size: 0.85rem;">Daftar</a>
                @endauth
            </div>

            <button id="hamburger-menu" title="Menu">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </nav>

    <section id="beranda" class="hero-section">
        <div class="hero-img-perpus"></div>
        <div class="hero-teks">
            <p style="color: var(--emerald); font-weight: 800; letter-spacing: 4px; font-size: 0.75rem; margin-bottom: 20px;">DIGITAL LIBRARY ECOSYSTEM</p>
            <h1>Literasi Tanpa <br><span>Sekat.</span></h1>
            <p class="fs-5 mb-4 hero-sub">Akses koleksi buku SMKN 2 secara digital dengan standar teknologi masa depan.</p>
            
            <form action="{{ route('login') }}" method="GET" class="search-box">
                <i class="bi bi-search me-3" style="color: var(--emerald);"></i>
                <input type="text" name="search" placeholder="Cari judul buku atau penulis...">
                <button type="submit" class="btn-mewah py-2 px-4" style="border-radius: 12px; font-size: 0.8rem;">Cari</button>
            </form>
        </div>
    </section>

    <section style="padding: 0 6% 100px;">
        <div class="row g-4">
            <div class="col-6 col-md-3"><div class="stat-item"><div class="stat-number">12K+</div><div class="small text-muted">Total Koleksi</div></div></div>
            <div class="col-6 col-md-3"><div class="stat-item"><div class="stat-number">3K+</div><div class="small text-muted">Siswa Aktif</div></div></div>
            <div class="col-6 col-md-3"><div class="stat-item"><div class="stat-number">450</div><div class="small text-muted">E-Book Baru</div></div></div>
            <div class="col-6 col-md-3"><div class="stat-item"><div class="stat-number">24/7</div><div class="small text-muted">Akses Digital</div></div></div>
        </div>
    </section>

    <section id="katalog" style="padding: 0 6%;">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div><h2 class="fw-800 mb-1">Koleksi Unggulan</h2><p class="text-muted">Jelajahi buku-buku terpopuler di SMEKDA</p></div>
            <a href="{{ route('login') }}" class="text-emerald text-decoration-none fw-bold">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="grid-buku">
            @forelse($semua_buku as $buku)
                <div class="kartu-buku" data-bs-toggle="modal" data-bs-target="#modalBuku{{ $buku->id }}">
                    <div class="sampul">
                        <img src="{{ $buku->cover ? asset('storage/covers/' . $buku->cover) : 'https://ui-avatars.com/api/?name='.urlencode($buku->judul).'&background=10b981&color=fff' }}">
                        <div class="status-badge {{ $buku->stok > 0 ? 'bg-success' : 'bg-danger' }}" style="position: absolute; top: 10px; right: 10px; font-size: 0.7rem; padding: 4px 10px; border-radius: 50px; font-weight: 700; z-index: 2; color: white;">
                            {{ $buku->stok > 0 ? 'Tersedia' : 'Habis' }}
                        </div>
                    </div>
                    <h6 class="fw-bold mb-1 text-truncate">{{ $buku->judul }}</h6>
                    <p class="small mb-0 text-muted text-truncate">{{ $buku->penulis }}</p>
                </div>
                <div class="modal fade" id="modalBuku{{ $buku->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content p-4">
                            <div class="modal-body">
                                <div class="row g-4">
                                    <div class="col-md-5">
                                        <img src="{{ $buku->cover ? asset('storage/covers/' . $buku->cover) : 'https://ui-avatars.com/api/?name='.urlencode($buku->judul).'&background=10b981&color=fff' }}" class="w-100 rounded-4 shadow">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="d-flex justify-content-between">
                                            <span class="badge bg-success mb-2 px-3 py-2 rounded-pill">{{ $buku->kategori }}</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <h2 class="fw-800 mb-1 mt-2">{{ $buku->judul }}</h2>
                                        <p class="text-emerald fw-bold mb-4">Oleh: {{ $buku->penulis }}</p>
                                        <p class="small text-muted lh-lg mb-4">{{ $buku->sinopsis ?? 'Sinopsis belum tersedia.' }}</p>
                                        <a href="{{ route('pinjam.form', ['buku_id' => $buku->id]) }}" class="btn-mewah w-100 {{ $buku->stok <= 0 ? 'disabled opacity-50' : '' }}">
                                            {{ $buku->stok > 0 ? 'PINJAM SEKARANG' : 'STOK HABIS' }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5"><p class="text-muted">Belum ada koleksi buku.</p></div>
            @endforelse
        </div>
    </section>

    <footer id="bantuan" class="footer-final">
        <div class="row g-5">
            <div class="col-lg-5">
                <a href="#" class="logo-smekda mb-3 d-block">SMEKDA<span>PERPUS</span></a>
                <p class="text-muted">Portal resmi perpustakaan digital SMKN 2 Purwakarta. Transformasi literasi untuk generasi digital.</p>
            </div>
            <div class="col-lg-3">
                <p class="fw-bold mb-4">Navigasi</p>
                <div class="footer-links">
                    <a href="#beranda">Halaman Utama</a>
                    <a href="#katalog">Koleksi Buku</a>
                    <a href="#cara-pinjam">Alur Peminjaman</a>
                </div>
            </div>
            <div class="col-lg-4">
                <p class="fw-bold mb-4">Kontak</p>
                <p class="small text-muted"><i class="bi bi-geo-alt me-2 text-emerald"></i> Nagri Tengah, Purwakarta</p>
                <p class="small text-muted"><i class="bi bi-envelope me-2 text-emerald"></i> perpus@smkn2pwk.sch.id</p>
            </div>
        </div>
        <hr class="my-5" style="border-color: var(--garis);">
        <p class="small text-center text-muted">© 2026 SIPUS SMEKDA. Developed by RPL.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Hamburger Toggle
        const hamburger = document.getElementById('hamburger-menu');
        const navLinks = document.getElementById('nav-links');
        const hamburgerIcon = hamburger.querySelector('i');

        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            hamburgerIcon.classList.toggle('bi-list');
            hamburgerIcon.classList.toggle('bi-x-lg');
        });

        // Theme Toggle Logic
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const htmlElement = document.documentElement;

        const savedTheme = localStorage.getItem('sipus-theme') || 'dark';
        htmlElement.setAttribute('data-theme', savedTheme);
        updateThemeIcon(savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            htmlElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('sipus-theme', newTheme);
            updateThemeIcon(newTheme);
        });

        function updateThemeIcon(theme) {
            if (theme === 'light') {
                themeIcon.classList.replace('bi-moon-stars-fill', 'bi-sun-fill');
            } else {
                themeIcon.classList.replace('bi-sun-fill', 'bi-moon-stars-fill');
            }
        }

        // Simple Particles
        const container = document.getElementById('particles-container');
        for (let i = 0; i < 15; i++) {
            const p = document.createElement('div');
            p.className = 'partikel';
            p.style.left = Math.random() * 100 + 'vw';
            p.style.width = p.style.height = Math.random() * 3 + 2 + 'px';
            p.style.animationDelay = Math.random() * 20 + 's';
            container.appendChild(p);
        }
    </script>
</body>
</html>