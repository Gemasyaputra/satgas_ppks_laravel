<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            
            {{-- Header Modal Modern --}}
            <div class="modal-header bg-gradient-to-r from-orange-50 to-white border-bottom-0 p-4">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-white text-orange-500 rounded-circle shadow-sm me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-plus-lg fw-bold"></i>
                    </div>
                    <h5 class="modal-title fw-bold text-dark" id="addServiceModalLabel">Tambah Layanan Baru</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.services.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    
                    {{-- Alert Info Kecil --}}
                    <div class="alert alert-light border-start border-warning border-3 py-2 px-3 mb-4 small text-muted">
                        <i class="bi bi-info-circle text-warning me-1"></i>
                        Isi detail layanan yang akan ditampilkan di halaman publik.
                    </div>

                    {{-- Input Judul --}}
                    <div class="mb-3">
                        <label for="title" class="form-label small fw-bold text-uppercase text-muted">Judul Layanan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="bi bi-type-h1 text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 bg-light ps-0 rounded-end-3" id="title" name="title" placeholder="Contoh: Hotline Darurat 24/7" required>
                        </div>
                    </div>

                    {{-- Input Deskripsi --}}
                    <div class="mb-3">
                        <label for="description" class="form-label small fw-bold text-uppercase text-muted">Deskripsi Singkat <span class="text-danger">*</span></label>
                        <textarea class="form-control bg-light rounded-3" id="description" name="description" rows="3" placeholder="Jelaskan fungsi layanan ini..." required></textarea>
                    </div>

                    {{-- Input Kontak --}}
                    <div class="mb-3">
                        <label for="phone" class="form-label small fw-bold text-uppercase text-muted">Info Kontak (HP/Email/IG) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="bi bi-link-45deg text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 bg-light ps-0 rounded-end-3" id="phone" name="phone" placeholder="Contoh: 081234567890 atau satgas@pnp.ac.id" required>
                        </div>
                        
                    </div>

                    <div class="row">
                        {{-- Input Icon --}}
                        
                    </div>

                </div>
                
                <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light text-muted fw-medium" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white fw-bold px-4 shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Simpan Layanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>