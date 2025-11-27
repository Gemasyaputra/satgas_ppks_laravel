<div class="modal fade" id="editServiceModal{{ $service->id }}" tabindex="-1" aria-labelledby="editServiceModalLabel{{ $service->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            
            {{-- Header Modal Modern --}}
            <div class="modal-header bg-gradient-to-r from-orange-50 to-white border-bottom-0 p-4">
                <div class="d-flex align-items-center">
                    <div class="icon-box bg-white text-primary rounded-circle shadow-sm me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-pencil-square fw-bold"></i>
                    </div>
                    <h5 class="modal-title fw-bold text-dark" id="editServiceModalLabel{{ $service->id }}">Edit Layanan</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    
                    {{-- Alert Info Kecil --}}
                    <div class="alert alert-light border-start border-primary border-3 py-2 px-3 mb-4 small text-muted">
                        <i class="bi bi-info-circle text-primary me-1"></i>
                        Perbarui informasi layanan yang tampil di halaman publik.
                    </div>

                    {{-- Input Judul --}}
                    <div class="mb-3">
                        <label for="title{{ $service->id }}" class="form-label small fw-bold text-uppercase text-muted">Judul Layanan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="bi bi-type-h1 text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 bg-light ps-0 rounded-end-3" id="title{{ $service->id }}" name="title" value="{{ $service->title }}" required>
                        </div>
                    </div>

                    {{-- Input Deskripsi --}}
                    <div class="mb-3">
                        <label for="description{{ $service->id }}" class="form-label small fw-bold text-uppercase text-muted">Deskripsi Singkat <span class="text-danger">*</span></label>
                        <textarea class="form-control bg-light rounded-3" id="description{{ $service->id }}" name="description" rows="3" required>{{ $service->description }}</textarea>
                    </div>

                    {{-- Input Kontak --}}
                    <div class="mb-3">
                        <label for="phone{{ $service->id }}" class="form-label small fw-bold text-uppercase text-muted">Info Kontak (HP/Email/IG) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="bi bi-link-45deg text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 bg-light ps-0 rounded-end-3" id="phone{{ $service->id }}" name="phone" value="{{ $service->phone }}" required>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Input Icon --}}
                        
                        
                    </div>

                </div>
                
                <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light text-muted fw-medium" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>