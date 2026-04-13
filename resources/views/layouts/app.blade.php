<!DOCTYPE html>
<html lang="id">
@include('layouts.header')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<script>
    /* Script IIFE untuk mencegah flash-of-white, prioritas data Database */
    (function() {
        const savedTheme = "@auth{{ auth()->user()->theme ?: 'dark' }}@else" + (localStorage.getItem('sipus-theme') || 'dark') + "@endauth";
        document.documentElement.setAttribute('data-theme', savedTheme);
    })();
</script>

<style>
    /* MASTERPIECE THEME DYNAMIC */
    :root {
        --dynamic-bg: #020617;
        --dynamic-card: #0f172a;
        --dynamic-text: #f1f5f9;
        --kaca-header: rgba(15, 23, 42, 0.8);
        --garis-halus: rgba(255, 255, 255, 0.08);
        --aksen-gradasi: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);
    }

    [data-theme="light"] {
        --dynamic-bg: #ffffff; 
        --dynamic-card: #ffffff;
        --dynamic-text: #0f172a;
        --kaca-header: rgba(255, 255, 255, 0.9);
        --garis-halus: rgba(15, 23, 42, 0.08);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--dynamic-bg) !important;
        color: var(--dynamic-text) !important;
        transition: background 0.3s ease, color 0.3s ease;
    }

    .border-role-admin { border: 2px solid #ef4444 !important; }
    .border-role-siswa { border: 2px solid #10b981 !important; }
    .border-role-default { border: 2px solid #94a3b8 !important; }

    /* HEADER ADJUSTMENT */
    .nxl-header {
        background: var(--kaca-header) !important;
        backdrop-filter: blur(15px) !important;
        border-bottom: 1px solid var(--garis-halus) !important;
        height: 75px !important;
        transition: background 0.3s ease;
        z-index: 2000 !important; /* Menaikkan z-index header agar profil bisa diklik */
    }

    /* NAVIGATION / SIDEBAR FIX */
    .nxl-navigation {
        z-index: 1010 !important;
        background: var(--dynamic-card) !important;
    }

    /* FIX REDUP: Mematikan overlay yang mengganggu klik dan kecerahan */
    .nxl-menu-overlay {
        display: none !important;
        opacity: 0 !important;
        visibility: hidden !important;
    }

    .header-wrapper {
        height: 100%;
        display: flex;
        align-items: center;
        overflow: visible !important;
    }

    #theme-icon {
        font-size: 1.2rem !important;
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .nxl-head-link i {
        color: #94a3b8 !important;
        transition: 0.3s;
    }
    .nxl-head-link:hover i {
        color: #10b981 !important;
        transform: scale(1.1);
    }

    .nxl-user-dropdown, .card {
        background: var(--dynamic-card) !important;
        border: 1px solid var(--garis-halus) !important;
        color: var(--dynamic-text) !important;
    }

    .dropdown.nxl-h-item {
        position: relative;
        display: flex;
        align-items: center;
        height: 100%;
    }

    /* Dropdown user harus sangat tinggi agar tidak tertutup konten */
    .nxl-user-dropdown {
        border-radius: 20px !important;
        box-shadow: 0 15px 35px rgba(0,0,0,0.4) !important;
        padding: 15px !important;
        margin-top: 0 !important;
        min-width: 230px;
        position: absolute !important;
        top: 70px !important;
        right: 0 !important;
        z-index: 99999 !important; 
    }

    @media (max-width: 1024px) {
        .nxl-container {
            z-index: 1 !important;
            position: relative;
        }
        .nxl-user-dropdown {
            right: 0 !important;
            left: auto !important;
            transform: translateX(0) !important;
        }
        .nxl-navigation {
            z-index: 3000 !important; /* Di mobile sidebar harus di atas header */
        }
        .nxl-header {
            z-index: 2500 !important;
        }
    }

    .nxl-user-dropdown::before {
        content: "";
        position: absolute;
        top: -15px;
        left: 0;
        width: 100%;
        height: 15px;
        background: transparent;
    }

    .dropdown-item {
        border-radius: 12px !important;
        padding: 10px 15px !important;
        color: #94a3b8 !important;
        transition: 0.3s;
        display: flex;
        align-items: center;
    }

    .dropdown-item i {
        font-size: 1.1rem;
        margin-right: 10px;
    }

    .dropdown-item:hover {
        background: rgba(16, 185, 129, 0.1) !important;
        color: #10b981 !important;
    }

    .dropdown-divider {
        border-top: 1px solid var(--garis-halus) !important;
        margin: 10px 0;
    }

    .nxl-container, .nxl-content {
        background-color: var(--dynamic-bg) !important;
    }

    .page-header h5 {
        font-weight: 800;
        letter-spacing: -0.5px;
        color: var(--dynamic-text) !important;
    }

    .breadcrumb-item a { color: #10b981 !important; text-decoration: none; }
    .breadcrumb-item.active { color: #64748b !important; }

    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--dynamic-bg); }
    ::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }

    .modal { z-index: 200000 !important; }
    .modal-dialog { position: relative; z-index: 200001 !important; }
    .modal-content { position: relative; z-index: 200002 !important; }
    .modal-backdrop { z-index: 199999 !important; }
</style>

<body>
    @include('layouts.sidebar')

    @php
        $avatarDefault = (auth()->user()->jenis_kelamin === 'Perempuan') 
                        ? 'duralux/assets/images/avatar/profilcewe.png' 
                        : 'duralux/assets/images/avatar/profilcowo.avif';

        $userProfile = \App\Models\Profile::where('user_id', auth()->id())->first();

        if ($userProfile && $userProfile->profile_photo && file_exists(public_path('storage/profile_photos/' . $userProfile->profile_photo))) {
            $finalPhoto = asset('storage/profile_photos/' . $userProfile->profile_photo) . '?v=' . time();
        } else {
            $finalPhoto = asset($avatarDefault);
        }
        
        $roleBorderClass = match(auth()->user()->role) {
            'Admin' => 'border-role-admin',
            'Siswa' => 'border-role-siswa',
            default => 'border-role-default', 
        };
    @endphp

    <header class="nxl-header">
        <div class="header-wrapper px-3">
            <div class="header-left d-flex align-items-center gap-4">
                <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box"><div class="hamburger-inner"></div></div>
                    </div>
                </a>
                <div class="nxl-navigation-toggle">
                    <a href="javascript:void(0);" id="menu-mini-button"><i class="feather-align-left"></i></a>
                </div>
            </div>

            <div class="header-right ms-auto d-flex align-items-center gap-3">
                <div class="nxl-h-item">
                    <a href="javascript:void(0);" class="nxl-head-link me-0" id="theme-toggle">
                        <i id="theme-icon" class="bi bi-moon-stars-fill"></i>
                    </a>
                </div>

                <div class="nxl-h-item d-none d-sm-flex">
                    <a href="javascript:void(0);" class="nxl-head-link me-0" id="btn-fullscreen">
                        <i class="feather-maximize maximize"></i>
                        <i class="feather-minimize minimize" style="display:none;"></i>
                    </a>
                </div>

                <div class="dropdown nxl-h-item">
                    <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button" aria-expanded="false" class="p-0 border-0 d-block" style="position: relative; z-index: 1060;">
                        <img src="{{ $finalPhoto }}" class="img-fluid user-avtar me-0 {{ $roleBorderClass }}" style="width: 38px; height: 38px; object-fit: cover; border-radius: 50%;" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                        <div class="d-flex align-items-center mb-3 px-2">
                            <img src="{{ $finalPhoto }}" class="img-fluid rounded-circle me-3 {{ $roleBorderClass }}" style="width: 45px; height: 45px; object-fit: cover; padding: 2px;" />
                            <div class="d-flex flex-column align-items-start">
                                <span class="fw-bold" style="color: var(--dynamic-text); font-size: 0.95rem;">{{ auth()->user()->nama }}</span>
                                <small class="text-muted" style="font-size: 0.75rem;">{{ auth()->user()->role }}</small>
                            </div>
                        </div>
                        
                        <div class="dropdown-divider"></div>

                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="bi bi-person-circle"></i> 
                            <span>Profil Saya</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger w-100 border-0 bg-transparent text-start">
                                <i class="bi bi-box-arrow-right"></i> 
                                <span class="ms-1">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header px-4 pt-4">
                <div class="page-header-left">
                    <h5 class="m-b-10">{{ $title1 }}</h5>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title2 }}</li>
                    </ul>
                </div>
            </div>
            @yield('content')
        </div>
        @include('layouts.footer')
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const themeToggle = document.getElementById('theme-toggle');
            const htmlElement = document.documentElement;
            const themeIcon = document.getElementById('theme-icon');

            function updateThemeUI(theme) {
                if(themeIcon) {
                    themeIcon.className = ''; 
                    themeIcon.classList.add('bi'); 
                    
                    if (theme === 'light') {
                        themeIcon.classList.add('bi-sun-fill');
                        themeIcon.style.color = '#f59e0b';
                    } else {
                        themeIcon.classList.add('bi-moon-stars-fill');
                        themeIcon.style.color = '#10b981';
                    }
                }
            }

            updateThemeUI(htmlElement.getAttribute('data-theme'));

            if (themeToggle) {
                themeToggle.addEventListener('click', () => {
                    const currentTheme = htmlElement.getAttribute('data-theme');
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    
                    htmlElement.setAttribute('data-theme', newTheme);
                    localStorage.setItem('sipus-theme', newTheme);
                    updateThemeUI(newTheme);

                    if ("{{ Auth::check() }}") { 
                        fetch("{{ route('update.theme') }}", {
                            method: 'POST',
                            headers: { 
                                'Content-Type': 'application/json', 
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                            },
                            body: JSON.stringify({ theme: newTheme })
                        })
                        .then(response => response.json())
                        .catch(err => console.error('DB Error:', err));
                    }
                });
            }

            $('#btn-fullscreen').on('click', function() {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                    $(this).find('.maximize').hide();
                    $(this).find('.minimize').show();
                } else {
                    document.exitFullscreen();
                    $(this).find('.maximize').show();
                    $(this).find('.minimize').hide();
                }
            });

            $('#mobile-collapse').on('click', function() {
                $('body').toggleClass('nxl-mobile-menu-opened');
            });

            document.querySelectorAll('.modal').forEach(modal => {
                if (modal.parentElement !== document.body) {
                    document.body.appendChild(modal);
                }
            });
        });
    </script>
</body>
</html>