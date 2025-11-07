@extends('layouts.admin')

@section('title', 'Manajemen Konselor')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h4 fw-medium mb-1">Manajemen Tim Satgas</h2>
                    <p class="text-muted mb-0">Kelola data anggota Satgas (mahasiswa dan tenaga pendidik).</p>
                </div>
                <button class="btn btn-warning text-white fw-bold" data-bs-toggle="modal" data-bs-target="#addCounselorModal">
                    <i class="bi bi-plus-circle-fill me-2"></i> Tambah Konselor
                </button>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Anggota Satgas</th>
                                <th scope="col">Peran</th>
                                <th scope="col">Spesialisasi</th>
                                <th scope="col">Kontak</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($counselors as $counselor)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $counselor->photo_url ? asset('storage/' . $counselor->photo_url) : 'https://via.placeholder.com/40' }}"
                                                alt="{{ $counselor->name }}"style="width: 40px; height: 40px; object-fit: cover;"
                                                ...>
                                            <div class="ms-3">
                                                <div class="fw-medium">{{ $counselor->name }}</div>
                                                <div class="text-muted small">{{ $counselor->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $counselor->role == 'Mahasiswa Satgas' ? 'bg-primary-subtle text-primary-emphasis' : 'bg-purple-subtle text-purple-emphasis' }}">
                                            {{ $counselor->role }}
                                        </span>
                                    </td>
                                    <td>
                                        <i class="bi bi-briefcase-fill text-warning me-1"></i>
                                        {{ $counselor->specialization }}
                                    </td>
                                    <td>{{ $counselor->phone }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $counselor->is_active ? 'bg-success-subtle text-success-emphasis' : 'bg-secondary-subtle text-secondary-emphasis' }}">
                                            {{ $counselor->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-link btn-sm text-primary" data-bs-toggle="modal"
                                            data-bs-target="#editCounselorModal{{ $counselor->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <form action="{{ route('admin.counselors.destroy', $counselor->id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus konselor ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link btn-sm text-danger">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                @include('admin.counselors._edit_modal', ['counselor' => $counselor])

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Belum ada data konselor.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $counselors->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('admin.counselors._add_modal')

@endsection
