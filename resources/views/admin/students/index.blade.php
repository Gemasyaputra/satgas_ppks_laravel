@extends('layouts.admin')

@section('title', 'Manajemen Mahasiswa')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h4 fw-medium mb-1">Manajemen Mahasiswa</h2>
                    <p class="text-muted mb-0">Kelola data mahasiswa yang terdaftar dalam sistem.</p>
                </div>
                <button class="btn btn-warning text-white fw-bold" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                    <i class="bi bi-plus-circle-fill me-2"></i> Tambah Mahasiswa
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
                <strong>Error!</strong> Terjadi kesalahan saat memproses data.
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Mahasiswa</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Program</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $student->photo_url ? asset('storage/' . $student->photo_url) : 'https://via.placeholder.com/40' }}"
                                                alt="{{ $student->name }}" class="rounded-circle me-3"
                                                style="width: 40px; height: 40px; object-fit: cover;">
                                            div class="ms-3"> <div class="fw-medium">{{ $student->name }}</div>
                                            <div class="text-muted small">{{ $student->email }}</div>
                                        </div>
                </div>
                </td>
                <td>
                    <i class="bi bi-person-vcard-fill text-warning me-1"></i>
                    {{ $student->nim }}
                </td>
                <td>
                    <span class="badge bg-primary-subtle text-primary-emphasis">
                        {{ $student->program }}
                    </span>
                </td>
                <td>{{ $student->department }}</td>
                <td>
                    <span
                        class="badge {{ $student->is_active ? 'bg-success-subtle text-success-emphasis' : 'bg-secondary-subtle text-secondary-emphasis' }}">
                        {{ $student->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </td>
                <td class="text-end">
                    <form action="{{ route('admin.students.toggleStatus', $student->id) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-link btn-sm text-secondary"
                            title="{{ $student->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                            <i class="bi {{ $student->is_active ? 'bi-person-x-fill' : 'bi-person-check-fill' }}"></i>
                        </button>
                    </form>

                    <button class="btn btn-link btn-sm text-primary" data-bs-toggle="modal"
                        data-bs-target="#editStudentModal{{ $student->id }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link btn-sm text-danger">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </form>
                </td>
                </tr>

                @include('admin.students._edit_modal', ['student' => $student])

            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        Belum ada data mahasiswa.
                    </td>
                </tr>
                @endforelse
                </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $students->links() }}
            </div>
        </div>
    </div>
    </div>

    @include('admin.students._add_modal')
@endsection
