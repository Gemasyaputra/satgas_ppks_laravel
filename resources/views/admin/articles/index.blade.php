@extends('layouts.admin')

@section('title', 'Manajemen Artikel')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h4 fw-medium mb-1">Manajemen Artikel & Edukasi</h2>
                    <p class="text-muted mb-0">Kelola konten artikel dan materi edukasi.</p>
                </div>
                <button class="btn btn-warning text-white fw-bold" data-bs-toggle="modal" data-bs-target="#addArticleModal">
                    <i class="bi bi-plus-circle-fill me-2"></i> Tambah Artikel
                </button>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Terjadi kesalahan. Pastikan semua field wajib diisi.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Judul</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Tanggal Terbit</th>
                                <th scope="col" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($articles as $article)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $article->image_url ? asset('storage/' . $article->image_url) : 'https://via.placeholder.com/150' }}"
                                                alt="{{ $article->title }}" class="img-fluid rounded-2xl me-3"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                            <div class="ms-3">
                                                <div class="fw-medium text-dark text-truncate" style="max-width: 300px;">
                                                    {{ $article->title }}</div>
                                                <div class="text-muted small text-truncate" style="max-width: 300px;">
                                                    {{ $article->excerpt }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning-subtle text-warning-emphasis">
                                            {{ $article->category }}
                                        </span>
                                    </td>
                                    <td>
                                        <i class="bi bi-person-fill text-muted me-1"></i>
                                        {{ $article->author }}
                                    </td>
                                    <td><span>
                                            <i class="bi bi-calendar-fill me-1"></i>
                                            @if ($article->published_at)
                                                {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-link btn-sm text-primary" data-bs-toggle="modal"
                                            data-bs-target="#editArticleModal{{ $article->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link btn-sm text-danger">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                @include('admin.articles._edit_modal', ['article' => $article])

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Belum ada artikel yang dipublikasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('admin.articles._add_modal')
@endsection
