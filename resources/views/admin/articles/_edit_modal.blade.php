<div class="modal fade" id="editArticleModal{{ $article->id }}" tabindex="-1"
    aria-labelledby="editArticleModalLabel{{ $article->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editArticleModalLabel{{ $article->id }}">Edit Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title{{ $article->id }}" class="form-label">Judul Artikel <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title{{ $article->id }}" name="title"
                            value="{{ $article->title }}" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="category{{ $article->id }}" class="form-label">Kategori <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" id="category{{ $article->id }}" name="category" required>
                                <option value="Edukasi" {{ $article->category == 'Edukasi' ? 'selected' : '' }}>Edukasi
                                </option>
                                <option value="Pencegahan" {{ $article->category == 'Pencegahan' ? 'selected' : '' }}>
                                    Pencegahan</option>
                                <option value="Panduan" {{ $article->category == 'Panduan' ? 'selected' : '' }}>Panduan
                                </option>
                                <option value="Berita" {{ $article->category == 'Berita' ? 'selected' : '' }}>Berita
                                </option>
                                <option value="Tips" {{ $article->category == 'Tips' ? 'selected' : '' }}>Tips
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="author{{ $article->id }}" class="form-label">Penulis <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="author{{ $article->id }}" name="author"
                                value="{{ $article->author }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image{{ $article->id }}" class="form-label">Ganti Gambar Artikel</label>
                        <input type="file" class="form-control" id="image{{ $article->id }}" name="image"
                            accept="image/png, image/jpeg, image/jpg">
                        <div class="form-text">Kosongkan jika tidak ingin mengubah gambar.</div>
                    </div>

                    <div class="mb-3">
                        <label for="excerpt{{ $article->id }}" class="form-label">Ringkasan (Excerpt) <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" id="excerpt{{ $article->id }}" name="excerpt" rows="2" required>{{ $article->excerpt }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="content{{ $article->id }}" class="form-label">Konten Artikel <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" id="content{{ $article->id }}" name="content" rows="10" required>{{ $article->content }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
