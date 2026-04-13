{{-- MODAL INFO --}}
<div class="modal fade" id="modalSampul{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <div class="modal-content shadow-lg border-0 overflow-hidden">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="{{ $item->cover ? asset('storage/covers/' . $item->cover) : 'https://ui-avatars.com/api/?name='.urlencode($item->judul).'&background=10b981&color=fff' }}" 
                         class="img-fluid h-100" 
                         style="object-fit: cover; min-height: 400px; width: 100%;">
                </div>
                <div class="col-md-7 d-flex flex-column">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-800 text-gradient">{{ $item->judul }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-6">
                                <small class="text-muted d-block">Penulis</small>
                                <span class="fw-600">{{ $item->penulis }}</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Kategori</small>
                                <span class="badge bg-success-subtle text-success rounded-pill px-3">{{ $item->kategori }}</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Penerbit</small>
                                <span class="fw-600">{{ $item->penerbit }}</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">ISBN</small>
                                <span class="fw-600 text-primary">{{ $item->isbn ?? '-' }}</span>
                            </div>
                            <div class="col-12 mt-4">
                                <label class="small text-uppercase fw-700 mb-2 d-block" style="color: var(--accent-emerald); font-size: 10px; letter-spacing: 1px;">Sinopsis Singkat</label>
                                <p style="color: var(--text-dim); font-size: 0.9rem;" class="lh-base">
                                    {{ $item->sinopsis ?? 'Informasi sinopsis belum tersedia untuk buku ini.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 mt-auto bg-light-subtle">
                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <div class="text-start">
                                <small class="text-muted d-block">Stok Tersedia</small>
                                <span class="fw-800 fs-5">{{ $item->stok }} <small class="fw-normal text-muted">Buku</small></span>
                            </div>
                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL HAPUS --}}
<div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 24px;">
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-trash3-fill text-danger" style="font-size: 3.5rem; opacity: 0.2; position: absolute; left: 50%; transform: translateX(-50%) translateY(-10px);"></i>
                    <i class="bi bi-exclamation-circle-fill text-danger position-relative" style="font-size: 3rem;"></i>
                </div>
                
                <h5 class="fw-800 mt-2">Konfirmasi Hapus</h5>
                <p class="text-muted small">Apakah Anda yakin ingin menghapus <b>{{ $item->judul }}</b>? Tindakan ini tidak dapat dibatalkan.</p>
                
                <div class="d-grid gap-2 mt-4">
                    <form action="{{ route('buku.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100 fw-bold py-2" style="border-radius: 12px;">
                            Ya, Hapus Buku
                        </button>
                    </form>
                    <button type="button" class="btn btn-light w-100 fw-bold py-2" data-bs-dismiss="modal" style="border-radius: 12px;">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>