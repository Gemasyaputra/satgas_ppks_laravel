@extends('layouts.admin')

@section('title', 'Manajemen Artikel')

@section('content')
<div class="container-fluid">
    {{-- Header Halaman --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 fw-medium mb-1">Manajemen Artikel & Edukasi</h2>
                <p class="text-muted mb-0">Kelola konten artikel dan materi edukasi untuk pengguna.</p>
            </div>
            <button class="btn btn-warning text-white fw-bold" data-bs-toggle="modal" data-bs-target="#addArticleModal">
                <i class="bi bi-plus-circle-fill me-2"></i> Tambah Artikel
            </button>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Terjadi kesalahan. Pastikan semua field wajib diisi.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Artikel --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 40%;">Artikel</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        {{-- Gambar Thumbnail --}}
                                        <img src="{{ $article->image_url ? asset('storage/' . $article->image_url) : 'https://via.placeholder.com/150' }}"
                                            alt="Thumbnail" class="rounded-3 border me-3"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                        
                                        <div>
                                            <div class="fw-bold text-dark text-truncate" style="max-width: 300px;">
                                                {{ $article->title }}
                                            </div>
                                            <div class="text-muted small text-truncate" style="max-width: 300px;">
                                                {{ Str::limit($article->excerpt ?? $article->content, 60) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info-subtle text-info-emphasis px-3 py-2 rounded-pill">
                                        {{ $article->category }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center text-muted">
                                        <i class="bi bi-person-circle me-2"></i>
                                        <span>{{ $article->author }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-secondary small">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        @if ($article->published_at)
                                            {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}
                                        @else
                                            <span class="text-muted fst-italic">Draft</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-end">
                                    {{-- Tombol Edit --}}
                                    <button class="btn btn-link btn-sm text-primary" data-bs-toggle="modal"
                                        data-bs-target="#editArticleModal{{ $article->id }}" title="Edit Artikel">
                                        <i class="bi bi-pencil-square fs-6"></i>
                                    </button>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link btn-sm text-danger" title="Hapus Artikel">
                                            <i class="bi bi-trash3-fill fs-6"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- INCLUDE MODAL EDIT (Memanggil file _edit_modal.blade.php) --}}
                            @include('admin.articles._edit_modal', ['article' => $article])

                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <div class="mb-2"><i class="bi bi-journal-x fs-1 opacity-25"></i></div>
                                    <h6 class="fw-bold">Belum ada artikel yang dipublikasi.</h6>
                                    <p class="small mb-0">Klik tombol "Tambah Artikel" untuk memulai.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($articles->hasPages())
                <div class="mt-4 d-flex justify-content-end">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

{{-- INCLUDE MODAL TAMBAH (Memanggil file _add_modal.blade.php) --}}
@include('admin.articles._add_modal')

@endsection