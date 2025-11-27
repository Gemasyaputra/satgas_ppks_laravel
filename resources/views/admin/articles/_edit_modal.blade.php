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
                <div class="modal-body text-start">
                    {{-- Judul --}}
                    <div class="mb-3">
                        <label for="title{{ $article->id }}" class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title{{ $article->id }}" name="title"
                            value="{{ $article->title }}" required>
                    </div>

                    <div class="row mb-3">
                        {{-- Kategori (Disamakan dengan Index & Add) --}}
                        <div class="col-md-6">
                            <label for="category{{ $article->id }}" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select" id="category{{ $article->id }}" name="category" required>
                                <option value="Kesehatan Mental" {{ $article->category == 'Kesehatan Mental' ? 'selected' : '' }}>Kesehatan Mental</option>
                                <option value="Akademik" {{ $article->category == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                <option value="Pengembangan Diri" {{ $article->category == 'Pengembangan Diri' ? 'selected' : '' }}>Pengembangan Diri</option>
                                <option value="Lainnya" {{ $article->category == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        {{-- Penulis --}}
                        <div class="col-md-6">
                            <label for="author{{ $article->id }}" class="form-label">Penulis <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="author{{ $article->id }}" name="author"
                                value="{{ $article->author }}" required>
                        </div>
                    </div>

                    {{-- Gambar --}}
                    <div class="mb-3">
                        <label for="image{{ $article->id }}" class="form-label">Gambar Sampul</label>
                        {{-- Preview Gambar Lama (Opsional, agar user tahu gambar saat ini) --}}
                        @if($article->image_url)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $article->image_url) }}" alt="Current Image" class="rounded" style="height: 60px; width: auto;">
                                <span class="text-muted small ms-2">Gambar saat ini</span>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="image{{ $article->id }}" name="image"
                            accept="image/png, image/jpeg, image/jpg">
                        <div class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</div>
                    </div>

                    {{-- Excerpt --}}
                    <div class="mb-3">
                        <label for="excerpt{{ $article->id }}" class="form-label">Ringkasan (Excerpt) <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="excerpt{{ $article->id }}" name="excerpt" rows="2" required>{{ $article->excerpt }}</textarea>
                    </div>

                    {{-- Konten --}}
                    <div class="mb-3">
                        <label for="content{{ $article->id }}" class="form-label">Konten Artikel <span class="text-danger">*</span></label>
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