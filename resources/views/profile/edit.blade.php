@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #059669 0%, #3b82f6 100%);
        --surface-color: #ffffff;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --border-color: #f1f5f9;
        --input-bg: #f8fafc;
    }

    [data-theme="dark"] {
        --surface-color: #0f172a;
        --text-main: #f1f5f9;
        --text-muted: #94a3b8;
        --border-color: rgba(255, 255, 255, 0.1);
        --input-bg: rgba(255, 255, 255, 0.03);
    }

    .nxl-content { 
        background-color: var(--input-bg); 
        padding: 2rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .bento-card {
        background: var(--surface-color);
        border: 1px solid var(--border-color);
        border-radius: 24px;
        padding: 1.5rem;
    }

    .profile-banner {
        height: 120px;
        background: var(--primary-gradient);
        border-radius: 20px 20px 0 0;
        margin: -1.5rem -1.5rem 0 -1.5rem;
    }

    .avatar-container {
        position: relative;
        margin-top: -65px;
        margin-bottom: 1.5rem;
    }

    .avatar-main {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        border: 5px solid var(--surface-color);
        object-fit: cover;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .sipus-input {
        background: var(--input-bg);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 0.75rem 1.2rem;
        color: var(--text-main);
        width: 100%;
    }

    .btn-update {
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 16px;
        padding: 1rem 2rem;
        font-weight: 700;
        width: 100%;
        transition: 0.3s;
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px -5px rgba(5, 150, 105, 0.4);
    }

    #cropperModal { z-index: 999999 !important; }
    .modal-backdrop { z-index: 999998 !important; }

    .modal-cropper-premium .modal-content {
        border-radius: 30px;
        border: none;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }
    
    .cropper-box {
        background: #000;
        border-radius: 20px;
        overflow: hidden;
        width: 100%;
        height: 380px;
    }

    .preview-box {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
        border: 5px solid #10b981;
        margin: 0 auto;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<div class="nxl-content">
    <div class="container-fluid">
        <div class="mb-5 px-2">
            <h3 class="fw-800 text-main mb-1">Personal Settings</h3>
            <p class="text-muted">Kelola akun {{ auth()->user()->nama }} di SIPUS SMEKDA</p>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" id="profileForm">
            @csrf
            <input type="hidden" name="cropped_image" id="croppedImageData">
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="bento-card text-center">
                        <div class="profile-banner"></div>
                        <div class="avatar-container">
                            @php
                                // Ambil data profile terbaru langsung dari model
                                $currentProfile = \App\Models\Profile::where('user_id', auth()->id())->first();
                                
                                $avatarDefault = (auth()->user()->jenis_kelamin === 'Perempuan') 
                                    ? 'duralux/assets/images/avatar/profilcewe.png' 
                                    : 'duralux/assets/images/avatar/profilcowo.avif';

                                // Cek apakah foto benar-benar ada di storage
                                if ($currentProfile && $currentProfile->profile_photo && file_exists(public_path('storage/profile_photos/' . $currentProfile->profile_photo))) {
                                    // Tambahkan timestamp (?v=...) agar browser tidak menampilkan foto lama (cache)
                                    $userPhoto = asset('storage/profile_photos/' . $currentProfile->profile_photo) . '?v=' . time();
                                } else {
                                    $userPhoto = asset($avatarDefault);
                                }
                            @endphp
                            
                            <img src="{{ $userPhoto }}" id="currentPhoto" class="avatar-main">
                        </div>
                        <h5 class="fw-800 mb-1 text-main">{{ auth()->user()->nama }}</h5>
                        <p class="text-muted small mb-4">{{ auth()->user()->email }}</p>
                        <div class="d-grid gap-2">
                            <label for="photoInput" class="btn btn-light fw-bold py-2 border-0" style="border-radius: 12px; background: var(--input-bg); cursor: pointer;">
                                <i class="bi bi-camera-fill me-2 text-primary"></i>Ganti Foto
                            </label>
                            <input type="file" id="photoInput" class="d-none" accept="image/*">
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="bento-card">
                        <h6 class="fw-800 mb-4 text-main">Informasi Dasar</h6>
                        <div class="row g-4">
                            <div class="col-md-6 form-group">
                                <label class="fw-700 text-muted small">NAMA LENGKAP</label>
                                <input type="text" name="nama" class="sipus-input" value="{{ auth()->user()->nama }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fw-700 text-muted small">EMAIL</label>
                                <input type="email" name="email" class="sipus-input" value="{{ auth()->user()->email }}" required>
                            </div>
                            <div class="col-12 mt-4">
                                <h6 class="fw-800 mb-4 text-main">Ubah Kata Sandi</h6>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fw-700 text-muted small">PASSWORD BARU</label>
                                <input type="password" name="password" class="sipus-input" placeholder="********">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="fw-700 text-muted small">KONFIRMASI PASSWORD</label>
                                <input type="password" name="password_confirmation" class="sipus-input" placeholder="********">
                            </div>
                        </div>
                        <div class="mt-5 pt-2">
                            <button type="submit" class="btn btn-update">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade modal-cropper-premium" id="cropperModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="modal-title fw-800 text-main">Sempurnakan Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 pt-0">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-7">
                        <div class="cropper-box">
                            <img id="imageToCrop" style="display: block; max-width: 100%;">
                        </div>
                    </div>
                    <div class="col-lg-5 text-center border-start">
                        <p class="small fw-800 text-muted mb-3">HASIL AKHIR</p>
                        <div class="preview-box">
                            <img id="previewImage">
                        </div>
                        <div class="d-grid gap-2 mt-5 px-3">
                            <button type="button" id="cropBtn" class="btn btn-primary fw-bold py-3 rounded-4">Terapkan</button>
                            <button type="button" class="btn btn-link text-muted fw-bold text-decoration-none" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    let cropper;
    const modalEl = $('#cropperModal');
    modalEl.appendTo('body');

    $('#photoInput').on('change', function(e) {
        if (e.target.files.length > 0) {
            const reader = new FileReader();
            reader.onload = function(event) {
                $('#imageToCrop').attr('src', event.target.result);
                modalEl.modal('show');
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    modalEl.on('shown.bs.modal', function() {
        if (cropper) cropper.destroy();
        cropper = new Cropper(document.getElementById('imageToCrop'), {
            aspectRatio: 1,
            viewMode: 1,
            dragMode: 'move',
            autoCropArea: 0.8,
            crop(event) {
                const canvas = cropper.getCroppedCanvas({ width: 250, height: 250 });
                $('#previewImage').attr('src', canvas.toDataURL());
            }
        });
    }).on('hidden.bs.modal', function() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        $('#photoInput').val('');
    });

    $('#cropBtn').on('click', function() {
        if (!cropper) return;
        const canvas = cropper.getCroppedCanvas({ width: 500, height: 500 });
        const dataURL = canvas.toDataURL('image/jpeg', 0.9);
        
        $('#croppedImageData').val(dataURL);
        $('#currentPhoto').attr('src', dataURL);
        
        modalEl.modal('hide');
        
        Swal.fire({ 
            icon: 'success', 
            title: 'Foto Terpasang!', 
            text: 'Klik Simpan Perubahan untuk memperbarui profil.',
            confirmButtonColor: '#059669'
        });
    });
});
</script>
@endsection