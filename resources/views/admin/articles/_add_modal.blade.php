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
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Artikel <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Masukkan judul artikel" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="Edukasi">Edukasi</option>
                                <option value="Pencegahan">Pencegahan</option>
                                <option value="Panduan">Panduan</option>
                                <option value="Berita">Berita</option>
                                <option value="Tips">Tips</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="author" class="form-label">Penulis <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="author" name="author"
                                value="{{ Auth::user()->name }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Artikel</label>
                        <input type="file" class="form-control" id="image" name="image"
                            accept="image/png, image/jpeg, image/jpg">
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Ringkasan (Excerpt) <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="2" placeholder="Ringkasan singkat artikel..."
                            required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Konten Artikel <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" id="content" name="content" rows="10"
                            placeholder="Tulis konten lengkap di sini..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white">Publikasikan Artikel</button>
                </div>
            </form>
        </div>
    </div>
</div>
