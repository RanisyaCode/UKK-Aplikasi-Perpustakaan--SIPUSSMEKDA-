<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil - SIPUS SMEKDA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #059669 0%, #3b82f6 100%);
            --surface-color: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --input-bg: #f8fafc;
            --emerald: #10b981;
        }

        body {
            background-color: #f1f5f9;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            font-size: 0.9rem; /* Ukuran font dasar lebih kecil */
        }

        .nxl-content { 
            padding: 1.5rem 1rem;
        }

        /* Container diperkecil lagi */
        .custom-container {
            max-width: 850px;
            margin: 0 auto;
        }

        .bento-card {
            background: var(--surface-color);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 1.25rem;
            height: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 1rem;
            transition: 0.2s;
        }
        .btn-back:hover { color: var(--emerald); }

        .profile-banner {
            height: 80px;
            background: var(--primary-gradient);
            border-radius: 14px 14px 0 0;
            margin: -1.25rem -1.25rem 0 -1.25rem;
        }

        .avatar-container {
            position: relative;
            margin-top: -45px;
            margin-bottom: 0.75rem;
            display: flex;
            justify-content: center;
        }

        .avatar-main {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 4px solid var(--surface-color);
            object-fit: cover;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .sipus-input {
            background: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 0.6rem 0.9rem;
            font-size: 0.88rem;
            color: var(--text-main);
            width: 100%;
            transition: 0.3s;
        }

        .sipus-input:focus {
            outline: none;
            border-color: var(--emerald);
            background: var(--surface-color);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .btn-update {
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.75rem;
            font-weight: 700;
            font-size: 0.9rem;
            width: 100%;
            transition: 0.3s;
        }

        .label-custom {
            font-weight: 700;
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.4rem;
            display: block;
        }

        /* Modal styling */
        .modal-content { border-radius: 20px; }
        .cropper-box { background: #000; border-radius: 12px; overflow: hidden; height: 300px; }
        .preview-box { width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 3px solid var(--emerald); margin: 0 auto; }
    </style>
</head>
<body>

<div class="nxl-content">
    <div class="custom-container">
        
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Dashboard
        </a>

        <div class="mb-3">
            <h4 class="fw-800 text-main mb-0">Pengaturan Profil</h4>
            <p class="text-muted small">Kelola akun Anda dengan mudah.</p>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" id="profileForm">
            @csrf
            <input type="hidden" name="cropped_image" id="croppedImageData">
            
            <div class="row g-3">
                <div class="col-lg-4">
                    <div class="bento-card text-center">
                        <div class="profile-banner"></div>
                        <div class="avatar-container">
                            @php
                                $currentProfile = \App\Models\Profile::where('user_id', auth()->id())->first();
                                $avatarDefault = (auth()->user()->jenis_kelamin === 'Perempuan') 
                                    ? 'duralux/assets/images/avatar/profilcewe.png' 
                                    : 'duralux/assets/images/avatar/profilcowo.avif';

                                if ($currentProfile && $currentProfile->profile_photo && file_exists(public_path('storage/profile_photos/' . $currentProfile->profile_photo))) {
                                    $userPhoto = asset('storage/profile_photos/' . $currentProfile->profile_photo) . '?v=' . time();
                                } else {
                                    $userPhoto = asset($avatarDefault);
                                }
                            @endphp
                            <img src="{{ $userPhoto }}" id="currentPhoto" class="avatar-main">
                        </div>
                        <h6 class="fw-800 mb-1 text-main">{{ auth()->user()->nama }}</h6>
                        <span class="badge mb-3 px-2 py-1" style="background: rgba(16, 185, 129, 0.1); color: var(--emerald); font-weight: 700; font-size: 0.7rem; border-radius: 8px;">
                           {{ auth()->user()->role }}
                        </span>
                        
                        <div class="d-grid">
                            <label for="photoInput" class="btn btn-light fw-700 py-2 border-0" style="border-radius: 10px; background: var(--input-bg); cursor: pointer; font-size: 0.8rem;">
                                <i class="bi bi-camera me-1"></i> Ubah Foto
                            </label>
                            <input type="file" id="photoInput" class="d-none" accept="image/*">
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="bento-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="p-2 rounded-3 bg-primary bg-opacity-10 me-2 text-primary" style="font-size: 1rem;">
                                <i class="bi bi-person-badge"></i>
                            </div>
                            <h6 class="fw-800 m-0 text-main" style="font-size: 0.95rem;">Informasi Dasar</h6>
                        </div>

                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="label-custom">Nama Lengkap</label>
                                <input type="text" name="nama" class="sipus-input" value="{{ auth()->user()->nama }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="label-custom">Email</label>
                                <input type="email" name="email" class="sipus-input" value="{{ auth()->user()->email }}" required>
                            </div>
                        </div>

                        <hr class="my-3" style="border-color: var(--border-color); opacity: 0.5;">

                        <div class="d-flex align-items-center mb-3">
                            <div class="p-2 rounded-3 bg-danger bg-opacity-10 me-2 text-danger" style="font-size: 1rem;">
                                <i class="bi bi-key"></i>
                            </div>
                            <h6 class="fw-800 m-0 text-main" style="font-size: 0.95rem;">Ganti Password</h6>
                        </div>
                        
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="label-custom">Password Baru</label>
                                <input type="password" name="password" class="sipus-input" placeholder="Kosongkan jika tidak ganti">
                            </div>
                            <div class="col-md-6">
                                <label class="label-custom">Konfirmasi</label>
                                <input type="password" name="password_confirmation" class="sipus-input" placeholder="Ulangi password">
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-update shadow-sm">
                                Update Profil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="cropperModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered"> <div class="modal-content">
            <div class="modal-header border-0 p-3 pb-0">
                <h6 class="modal-title fw-800">Potong Foto</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="font-size: 0.7rem;"></button>
            </div>
            <div class="modal-body p-3 text-center">
                <div class="cropper-box mb-3">
                    <img id="imageToCrop" style="display: block; max-width: 100%;">
                </div>
                <div class="preview-box mb-3">
                    <img id="previewImage" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="d-grid">
                    <button type="button" id="cropBtn" class="btn btn-primary fw-bold py-2 rounded-3 border-0" style="background: var(--primary-gradient); font-size: 0.85rem;">Terapkan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    let cropper;
    const modalEl = new bootstrap.Modal(document.getElementById('cropperModal'));

    $('#photoInput').on('change', function(e) {
        if (e.target.files.length > 0) {
            const reader = new FileReader();
            reader.onload = function(event) {
                $('#imageToCrop').attr('src', event.target.result);
                modalEl.show();
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    document.getElementById('cropperModal').addEventListener('shown.bs.modal', function() {
        if (cropper) cropper.destroy();
        cropper = new Cropper(document.getElementById('imageToCrop'), {
            aspectRatio: 1,
            viewMode: 1,
            dragMode: 'move',
            autoCropArea: 0.9,
            crop(event) {
                const canvas = cropper.getCroppedCanvas({ width: 250, height: 250 });
                $('#previewImage').attr('src', canvas.toDataURL());
            }
        });
    });

    $('#cropBtn').on('click', function() {
        const canvas = cropper.getCroppedCanvas({ width: 300, height: 300 });
        const dataURL = canvas.toDataURL('image/jpeg', 0.8);
        $('#croppedImageData').val(dataURL);
        $('#currentPhoto').attr('src', dataURL);
        modalEl.hide();
        Swal.fire({ icon: 'success', title: 'Siap!', text: 'Klik Update Profil untuk menyimpan.', confirmButtonColor: '#10b981', timer: 2000 });
    });
});
</script>

</body>
</html>