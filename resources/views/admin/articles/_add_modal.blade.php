<div class="modal fade" id="addArticleModal" tabindex="-1" aria-labelledby="addArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addArticleModalLabel">Tambah Artikel Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Judul --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Masukkan judul artikel yang menarik..." required>
                    </div>

                    <div class="row mb-3">
                        {{-- Kategori (Disamakan dengan Index/Edit) --}}
                        <div class="col-md-6">
                            <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="" selected disabled>Pilih Kategori</option>
                                <option value="Kesehatan Mental">Kesehatan Mental</option>
                                <option value="Akademik">Akademik</option>
                                <option value="Pengembangan Diri">Pengembangan Diri</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        {{-- Penulis (Otomatis nama Admin) --}}
                        <div class="col-md-6">
                            <label for="author" class="form-label">Penulis <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="author" name="author"
                                value="{{ Auth::user()->name }}" required>
                        </div>
                    </div>

                    {{-- Upload Gambar --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Sampul</label>
                        <input type="file" class="form-control" id="image" name="image"
                            accept="image/png, image/jpeg, image/jpg">
                        <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                    </div>

                    {{-- Ringkasan (Excerpt) --}}
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Ringkasan Singkat (Excerpt) <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="2" 
                            placeholder="Tulis ringkasan singkat untuk ditampilkan di kartu artikel..." required></textarea>
                    </div>

                    {{-- Konten Utama --}}
                    <div class="mb-3">
                        <label for="content" class="form-label">Konten Artikel <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="content" name="content" rows="10"
                            placeholder="Tulis isi lengkap artikel di sini..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white fw-bold">Publikasikan Artikel</button>
                </div>
            </form>
        </div>
    </div>
</div>