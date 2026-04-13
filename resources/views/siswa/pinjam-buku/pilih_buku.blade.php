<!DOCTYPE html>
<html lang="id" data-theme="{{ auth()->user()->theme ?? 'dark' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPUS SMEKDA | Terminal Pengembalian</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        :root {
            --bg-deep: #010307;
            --accent-emerald: #10b981;
            --accent-blue: #3b82f6;
            --accent-danger: #ef4444;
            --accent-warning: #f59e0b;
            --text-main: #ffffff;
            --text-muted: #cbd5e1;
            --card-glass: rgba(10, 15, 25, 0.85);
            --border-bright: rgba(255, 255, 255, 0.15);
            --gradasi: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);
            --latar-radial: radial-gradient(circle at 50% 10%, #0f172a 0%, #010307 100%);
            --item-bg: rgba(255, 255, 255, 0.04);
        }

        [data-theme="light"] {
            --bg-deep: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --card-glass: rgba(255, 255, 255, 0.9);
            --border-bright: rgba(15, 23, 42, 0.1);
            --latar-radial: radial-gradient(circle at 50% 10%, #f1f5f9 0%, #f8fafc 100%);
            --item-bg: rgba(15, 23, 42, 0.04);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-deep);
            color: var(--text-main);
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            overflow-x: hidden;
            transition: background 0.3s ease, color 0.3s ease;
            padding-top: 5vh;
        }

        #particles-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .partikel {
            position: absolute;
            background: var(--accent-emerald);
            border-radius: 50%;
            opacity: 0;
            bottom: -20px;
            filter: blur(1px);
            box-shadow: 0 0 10px var(--accent-emerald);
            animation: terbang linear infinite;
        }

        @keyframes terbang {
            0% { transform: translateY(0) scale(1); opacity: 0; }
            20% { opacity: 0.5; }
            100% { transform: translateY(-110vh) scale(0.5); opacity: 0; }
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }

        .btn-floating-info {
            animation: floating 3s ease-in-out infinite;
            display: inline-flex;
            align-items: center;
            color: var(--accent-blue);
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .btn-floating-info:hover {
            color: var(--accent-emerald);
            transform: scale(1.05);
        }

        .latar-animasi {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background: var(--latar-radial);
        }

        .container-main {
            width: 100%;
            max-width: 1200px;
            padding: 2rem;
            display: grid;
            grid-template-columns: 1fr 0.92fr;
            gap: 3.5rem;
            position: relative;
            z-index: 1;
            align-items: start;
        }

        .title-huge {
            font-size: 3.2rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -2px;
            margin-bottom: 1.2rem;
            color: var(--text-main);
        }

        .title-huge span {
            background: var(--gradasi);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .control-panel {
            background: var(--card-glass);
            border: 1px solid var(--border-bright);
            border-radius: 32px;
            padding: 2.5rem;
            backdrop-filter: blur(40px);
            box-shadow: 0 40px 100px -20px rgba(0, 0, 0, 0.2);
        }

        .status-history-item {
            background: var(--item-bg);
            border: 1px solid var(--border-bright);
            border-radius: 20px;
            padding: 16px 20px;
            margin-bottom: 12px;
            transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .status-history-item:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
        }

        .note-bubble {
            background: rgba(245, 158, 11, 0.08);
            border: 1px solid rgba(245, 158, 11, 0.2);
            border-radius: 14px;
            padding: 12px 15px;
            margin-top: 12px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .note-bubble i { color: var(--accent-warning); font-size: 1.1rem; }
        .note-text { color: var(--accent-warning); font-size: 0.85rem; line-height: 1.4; font-weight: 500; margin: 0; opacity: 0.9; }

        [data-theme="dark"] .note-text { color: #fde68a; }

        .note-label {
            display: block;
            font-size: 0.65rem;
            font-weight: 800;
            color: var(--accent-warning);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 3px;
        }

        .badge-status {
            padding: 5px 12px;
            border-radius: 100px;
            font-size: 0.6rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .bg-success-alt { background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); }
        .bg-pending { background: rgba(59, 130, 246, 0.15); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.3); }
        .bg-rejected { background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); }

        .btn-luxe {
            background: var(--gradasi);
            color: #ffffff !important;
            border: none;
            padding: 1.1rem;
            border-radius: 18px;
            font-weight: 800;
            width: 100%;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-luxe:hover:not(:disabled) { transform: scale(1.02); box-shadow: 0 15px 30px -10px rgba(16, 185, 129, 0.5); }
        .btn-luxe:disabled { opacity: 0.4; cursor: not-allowed; filter: grayscale(1); }

        .btn-ghost:hover { opacity: 1 !important; color: var(--accent-emerald) !important; }

        .book-selector-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(95px, 1fr));
            gap: 15px;
            margin-bottom: 1.5rem;
        }

        .book-option {
            cursor: pointer;
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid transparent;
            transition: 0.3s;
            background: var(--item-bg);
            display: flex;
            flex-direction: column;
        }

        .modal-content-luxe {
            background: var(--card-glass);
            backdrop-filter: blur(40px);
            border: 1px solid var(--border-bright);
            border-radius: 35px;
            overflow: hidden;
        }

        .guide-item {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            margin-bottom: 25px;
        }

        .guide-number {
            width: 35px;
            height: 35px;
            background: var(--gradasi);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: white;
            flex-shrink: 0;
            font-size: 0.9rem;
            box-shadow: 0 5px 15px -5px rgba(16, 185, 129, 0.4);
        }

        .guide-text h6 { font-weight: 700; color: var(--text-main); margin-bottom: 4px; font-size: 0.95rem; }
        .guide-text p { font-size: 0.85rem; color: var(--text-muted); margin: 0; line-height: 1.5; }

        @media (max-width: 992px) {
            .container-main { grid-template-columns: 1fr; }
            body { padding-top: 2vh; }
        }
    </style>
</head>
<body>

    <div class="latar-animasi"></div>
    <div id="particles-container"></div>

    <div class="container-main">
        <div class="hero-content">
            <div class="header-status-wrapper d-flex gap-3 mb-4">
                <div class="chip-status" style="background: rgba(16, 185, 129, 0.15); color: #10b981; padding: 10px 20px; border-radius: 100px; font-weight: 800; font-size: 0.75rem; border: 1px solid rgba(16, 185, 129, 0.3);">
                    <i class="bi bi-arrow-left-right me-2"></i>MENU PENGEMBALIAN
                </div>
            </div>

            <h1 class="title-huge">Buku <span>Kembali</span><br>Akses Terbuka.</h1>
            <p class="subtitle" style="color: var(--text-muted); opacity: 0.8;">Validasi pengembalian koleksi secara mandiri dengan verifikasi sistem terpadu.</p>

            <div class="book-card-mini" style="background: var(--card-glass); border: 1px solid var(--border-bright); border-radius: 35px; padding: 2rem;">
                <label style="color: var(--accent-emerald); font-weight: 800; font-size: 0.75rem; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 1.5rem; display: block;">Pinjaman Saat Ini</label>

                @forelse($bukuDipinjam ?? [] as $item)
                    <div class="status-history-item mb-3">
                        <div class="d-flex align-items-start gap-3">
                            <div style="width: 55px; height: 75px; border-radius: 10px; overflow: hidden; flex-shrink: 0; background: rgba(255,255,255,0.05); border: 1px solid var(--border-bright);">
                                <img src="{{ asset('storage/covers/' . $item->buku->cover) }}"
                                     style="width: 100%; height: 100%; object-fit: cover;"
                                     alt="{{ $item->buku->judul }}"
                                     onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($item->buku->judul) }}&background=10b981&color=fff&size=128';">
                            </div>

                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span style="color: var(--text-main); font-weight: 800; font-size: 1rem;">{{ $item->buku->judul }}</span>
                                    @if(isset($item->tanggal_kembali) && now()->greaterThan($item->tanggal_kembali))
                                        <span style="color: var(--accent-danger); font-size: 0.65rem; font-weight: 800; background: rgba(239, 68, 68, 0.1); padding: 2px 8px; border-radius: 4px;">TERLAMBAT</span>
                                    @endif
                                </div>
                                <div style="color: var(--text-muted); font-size: 0.8rem; margin-bottom: 5px;">
                                    Batas: <span style="color: var(--text-main);" class="fw-bold">{{ isset($item->tanggal_kembali) ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') : '-' }}</span>
                                </div>

                                @if(!empty($item->catatan) && $item->catatan != '-')
                                    <div class="note-bubble">
                                        <i class="bi bi-chat-square-quote-fill"></i>
                                        <div>
                                            <span class="note-label">Catatan Guru</span>
                                            <p class="note-text">{{ $item->catatan }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-3 text-muted" style="font-size: 0.85rem;">Antrian log kosong.</div>
                @endforelse
            </div>
        </div>

        <div class="control-area">
            <div class="control-panel">
                @php $menunggu = ($riwayat ?? collect())->where('status', 'Menunggu Verifikasi')->first(); @endphp
                @if($menunggu)
                    <div class="alert shadow-sm border-0 mb-4" style="background: rgba(59, 130, 246, 0.1); border-left: 4px solid var(--accent-blue) !important; border-radius: 18px;">
                        <div class="d-flex gap-2 align-items-center">
                            <i class="bi bi-info-circle-fill" style="color: var(--accent-blue);"></i>
                            <div style="font-size: 0.75rem; color: var(--text-main); font-weight: 600;">
                                <strong style="color: var(--accent-blue);">Instruksi:</strong> Serahkan buku fisik ke petugas SMEKDA.
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mb-4">
                    <h5 class="fw-800 mb-1" style="color: var(--text-main);">Panel Pengembalian</h5>
                    <p style="color: var(--text-muted); font-size: 0.85rem; margin: 0;">Status Pengembalian Anda:</p>
                </div>

                <div class="mb-4">
                    @foreach(($riwayat ?? collect())->take(2) as $r)
                        @php
                            $statusRaw = $r->status ?? 'PROSES';
                            $statusLow = strtolower($statusRaw);
                            $adaCatatanTolak = !empty($r->catatan) && $r->catatan !== '-';
                            $isSelesai = str_contains($statusLow, 'selesai') || str_contains($statusLow, 'kembali');
                            $isTolak = str_contains($statusLow, 'tolak') || str_contains($statusLow, 'reject') || $adaCatatanTolak;
                            $isDipinjam = ($statusLow === 'dipinjam') && !$isTolak;

                            if ($isSelesai) {
                                $statusColor = 'var(--accent-emerald)';
                                $statusLabel = 'Berhasil Kembali';
                                $iconClass = 'bi-check-circle-fill text-success';
                            } elseif ($isTolak) {
                                $statusColor = 'var(--accent-danger)';
                                $statusLabel = 'Pengembalian Ditolak';
                                $iconClass = 'bi-x-circle-fill text-danger';
                            } elseif ($isDipinjam) {
                                $statusColor = 'var(--accent-warning)';
                                $statusLabel = 'Sedang Dipinjam';
                                $iconClass = 'bi-book-half text-warning';
                            } else {
                                $statusColor = 'var(--accent-blue)';
                                $statusLabel = 'Sedang Diverifikasi';
                                $iconClass = 'bi-clock-history text-primary';
                            }
                        @endphp

                        <div class="status-history-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-3 align-items-center">
                                    <i class="bi {{ $iconClass }} fs-5"></i>
                                    <div>
                                        <div style="color: var(--text-main); font-weight: 700; font-size: 0.9rem;">
                                            {{ \Illuminate\Support\Str::limit($r->buku->judul ?? 'Buku', 20) }}
                                        </div>
                                        <div style="font-size: 0.75rem; font-weight: 600; color: <?= $statusColor ?>;">
                                            {{ $statusLabel }}
                                        </div>
                                    </div>
                                </div>
                                <span class="badge-status {{ $isSelesai ? 'bg-success-alt' : ($isTolak ? 'bg-rejected' : 'bg-pending') }}">
                                    {{ $isTolak ? 'DITOLAK' : $statusRaw }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <hr style="border-color: var(--border-bright); margin: 1.5rem 0;">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <label style="color: var(--accent-emerald); font-weight: 800; font-size: 0.7rem; margin: 0; display: block; letter-spacing: 1.5px; text-transform: uppercase;">PILIH BUKU UNTUK DIKEMBALIKAN:</label>
                    <button type="button" class="btn p-0 btn-floating-info" data-bs-toggle="modal" data-bs-target="#modalProses">
                        <i class="bi bi-info-circle me-1"></i> LIHAT PROSES PENGEMBALIAN
                    </button>
                </div>

                <form action="{{ route('pengembalian.update', 0) }}" method="POST" id="returnForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="transaksi_id" id="selectedTransaksiId" required>

                    <div class="book-selector-grid">
                        @foreach($bukuDipinjam ?? [] as $item)
                            <div class="book-option" onclick="selectBook(this, '{{ $item->id }}')">
                                <div class="check-badge" style="position: absolute; top: 5px; right: 5px; background: var(--accent-emerald); color: white; border-radius: 50%; width: 20px; height: 20px; display: none; align-items: center; justify-content: center; font-size: 0.7rem; z-index: 2;">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <img src="{{ asset('storage/covers/' . $item->buku->cover) }}"
                                     alt="{{ $item->buku->judul }}"
                                     style="width: 100%; aspect-ratio: 3/4; object-fit: cover; opacity: 0.6; transition: 0.4s;"
                                     onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($item->buku->judul) }}&background=10b981&color=fff&size=128';">
                                <div style="padding: 8px 5px; background: rgba(0,0,0,0.6); font-size: 0.65rem; color: white; text-align: center; font-weight: 700; flex-grow: 1; display: flex; align-items: center; justify-content: center;">
                                    {{ \Illuminate\Support\Str::limit($item->buku->judul, 12) }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn-luxe" id="submitBtn" disabled>
                        AJUKAN PENGEMBALIAN <i class="bi bi-send-fill ms-2"></i>
                    </button>
                </form>

                <a href="{{ route('dashboard') }}" class="btn-ghost d-block text-center mt-4 text-decoration-none" style="color: var(--text-main); font-weight: 700; font-size: 0.85rem; opacity: 0.5; transition: 0.3s;">
                    <i class="bi bi-chevron-left me-1"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalProses" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-content-luxe border-0 shadow-lg animate__animated animate__fadeInUp">
                <div class="modal-header border-0 p-4">
                    <h5 class="modal-title fw-800" style="color: var(--text-main);">Prosedur Pengembalian</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 px-md-5 pb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="guide-item">
                                <div class="guide-number">1</div>
                                <div class="guide-text">
                                    <h6>Akses Akun</h6>
                                    <p>Login menggunakan Email dan password yang sudah terdaftar.</p>
                                </div>
                            </div>
                            <div class="guide-item">
                                <div class="guide-number">2</div>
                                <div class="guide-text">
                                    <h6>Menu Pengembalian</h6>
                                    <p>Masuk ke menu Pengembalian pada sidebar navigasi.</p>
                                </div>
                            </div>
                            <div class="guide-item">
                                <div class="guide-number">3</div>
                                <div class="guide-text">
                                    <h6>Ajukan Sistem</h6>
                                    <p>Pilih buku dan klik tombol <strong>Ajukan Pengembalian</strong>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="guide-item">
                                <div class="guide-number">4</div>
                                <div class="guide-text">
                                    <h6>Status Verifikasi</h6>
                                    <p>Status akan berubah menjadi <strong>Menunggu Verifikasi</strong>.</p>
                                </div>
                            </div>
                            <div class="guide-item">
                                <div class="guide-number">5</div>
                                <div class="guide-text">
                                    <h6>Penyerahan Fisik</h6>
                                    <p>Serahkan buku fisik ke petugas untuk pengecekan kondisi & denda.</p>
                                </div>
                            </div>
                            <div class="guide-item">
                                <div class="guide-number">6</div>
                                <div class="guide-text">
                                    <h6>Validasi & Selesai</h6>
                                    <p>Setelah divalidasi petugas, status akan berubah menjadi <strong>Selesai</strong>.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 p-4" style="background: rgba(245, 158, 11, 0.08); border: 1px dashed var(--accent-warning); border-radius: 25px;">
                        <div class="d-flex gap-3">
                            <div style="background: var(--accent-warning); color: black; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                            </div>
                            <div>
                                <h6 class="text-warning fw-800 mb-1" style="font-size: 0.8rem; text-transform: uppercase;">Catatan Penting:</h6>
                                <p style="color: var(--text-muted); font-size: 0.85rem; margin: 0; line-height: 1.4;">Pengajuan di sistem belum dianggap selesai sebelum buku fisik diserahkan ke petugas perpustakaan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const msgSuccess = "{{ session('success') }}";
        const msgError = "{{ session('error') }}";

        const getThemeConfig = () => {
            const isLight = document.documentElement.getAttribute('data-theme') === 'light';
            return {
                background: isLight ? '#ffffff' : 'rgba(15, 23, 42, 0.95)',
                color: isLight ? '#1e293b' : '#ffffff',
                confirmButtonColor: '#10b981',
                backdrop: isLight ? 'rgba(0,0,0,0.2)' : 'rgba(2, 6, 23, 0.7)',
            };
        };

        if (msgSuccess) {
            const config = getThemeConfig();
            Swal.fire({
                icon: 'success',
                title: '<span style="font-weight:800; font-family:\'Plus Jakarta Sans\'">Berhasil!</span>',
                html: `<span style="font-family:\'Plus Jakarta Sans\'; font-size: 0.9rem;">${msgSuccess}</span>`,
                background: config.background, color: config.color,
                confirmButtonColor: config.confirmButtonColor, backdrop: config.backdrop,
                customClass: { popup: 'rounded-4 border-0 shadow-lg' }
            });
        }

        if (msgError) {
            const config = getThemeConfig();
            Swal.fire({
                icon: 'error',
                title: '<span style="font-weight:800; font-family:\'Plus Jakarta Sans\'">Terjadi Kesalahan</span>',
                html: `<span style="font-family:\'Plus Jakarta Sans\'; font-size: 0.9rem;">${msgError}</span>`,
                background: config.background, color: config.color,
                confirmButtonColor: '#ef4444', backdrop: config.backdrop,
                customClass: { popup: 'rounded-4 border-0 shadow-lg' }
            });
        }

        function selectBook(element, id) {
            document.querySelectorAll('.book-option').forEach(opt => {
                opt.style.borderColor = 'transparent';
                opt.querySelector('img').style.opacity = '0.6';
                opt.querySelector('.check-badge').style.display = 'none';
                opt.style.transform = 'scale(1)';
            });

            element.style.borderColor = 'var(--accent-emerald)';
            element.querySelector('img').style.opacity = '1';
            element.querySelector('.check-badge').style.display = 'flex';
            element.style.transform = 'scale(1.05)';

            const hiddenInput = document.getElementById('selectedTransaksiId');
            const form = document.getElementById('returnForm');
            const btn = document.getElementById('submitBtn');

            hiddenInput.value = id;
            form.action = form.action.substring(0, form.action.lastIndexOf('/')) + '/' + id;
            btn.disabled = false;
        }

        const particleContainer = document.getElementById('particles-container');
        function createParticle() {
            if(!particleContainer) return;
            const p = document.createElement('div');
            p.className = 'partikel';
            p.style.left = Math.random() * 100 + 'vw';
            const size = (Math.random() * 3 + 2) + 'px';
            p.style.width = size; p.style.height = size;
            p.style.animationDuration = (Math.random() * 8 + 7) + 's';
            particleContainer.appendChild(p);
            setTimeout(() => { p.remove(); }, 15000);
        }
        setInterval(createParticle, 600);
    </script>
</body>
</html>