<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.services.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceModalLabel">Tambah Layanan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Layanan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Contoh: Hotline Darurat 24/7" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Deskripsi singkat layanan" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Kontak (Telepon/Email) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="0800-123-456 atau satgas@pnp.ac.id" required>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Nama Ikon Bootstrap</label>
                        <input type="text" class="form-control" id="icon" name="icon" value="telephone-fill" placeholder="Contoh: telephone-fill, envelope-fill">
                        <div class="form-text">Lihat nama ikon di <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white">Tambah Layanan</button>
                </div>
            </form>
        </div>
    </div>
</div>