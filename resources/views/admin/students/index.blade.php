@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="container-fluid">
    
    {{-- Header Page --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4 d-flex justify-content-between align-items-center bg-gradient-to-r from-orange-50 to-white rounded-3">
            <div>
                <h2 class="h4 fw-bold text-dark mb-1">Manajemen Pengguna</h2>
                <p class="text-muted mb-0 small">Kelola data Pengguna yang terdaftar dalam sistem Satgas PPKPT.</p>
            </div>
            <button class="btn btn-warning text-white fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                <i class="bi bi-plus-lg me-2"></i> Tambah Pengguna
            </button>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center mb-1">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Terjadi Kesalahan!</strong>
            </div>
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Pengguna --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary small text-uppercase">
                        <tr>
                            <th scope="col" class="ps-4 py-3 border-0 rounded-start">Pengguna</th>
                            <th scope="col" class="py-3 border-0">NIM</th>
                            <th scope="col" class="py-3 border-0">Program Studi</th>
                            <th scope="col" class="py-3 border-0">Jurusan</th>
                            <th scope="col" class="py-3 border-0">Status Akun</th>
                            <th scope="col" class="text-end pe-4 py-3 border-0 rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                {{-- Kolom Foto & Nama --}}
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        @if($student->photo_url)
                                            <img src="{{ asset('storage/' . $student->photo_url) }}" 
                                                 alt="{{ $student->name }}" 
                                                 class="rounded-circle object-fit-cover border shadow-sm" 
                                                 style="width: 45px; height: 45px;">
                                        @else
                                            <div class="rounded-circle bg-info-subtle text-info-emphasis d-flex align-items-center justify-content-center fw-bold border border-info-subtle" 
                                                 style="width: 45px; height: 45px; font-size: 1.1rem;">
                                                {{ substr($student->name, 0, 1) }}
                                            </div>
                                        @endif
                                        
                                        <div class="ms-3">
                                            <div class="fw-bold text-dark">{{ $student->name }}</div>
                                            <div class="text-muted small" style="font-size: 0.8rem;">
                                                <i class="bi bi-envelope me-1"></i>{{ $student->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom NIM --}}
                                <td>
                                    <span class="font-monospace text-dark fw-medium bg-light px-2 py-1 rounded border">
                                        {{ $student->nim }}
                                    </span>
                                </td>

                                {{-- Kolom Program --}}
                                <td>
                                    <span class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle rounded-pill px-3">
                                        {{ $student->program }}
                                    </span>
                                </td>

                                {{-- Kolom Jurusan --}}
                                <td class="text-secondary">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-building text-muted me-2"></i>
                                        {{ $student->department }}
                                    </div>
                                </td>

                                {{-- Kolom Status --}}
                                <td>
                                    @if($student->is_active)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2">
                                            <i class="bi bi-check-circle-fill me-1"></i> Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2">
                                            <i class="bi bi-slash-circle me-1"></i> Non-Aktif
                                        </span>
                                    @endif
                                </td>

                                {{-- Kolom Aksi --}}
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        {{-- Tombol Toggle Status --}}
                                        <form action="{{ route('admin.students.toggleStatus', $student->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-light border-0" 
                                                title="{{ $student->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}">
                                                <i class="bi {{ $student->is_active ? 'bi-person-fill-slash text-warning' : 'bi-person-check-fill text-success' }} fs-6"></i>
                                            </button>
                                        </form>

                                        {{-- Tombol Edit --}}
                                        <button class="btn btn-sm btn-light text-primary border-0" data-bs-toggle="modal"
                                            data-bs-target="#editStudentModal{{ $student->id }}" title="Edit Data">
                                            <i class="bi bi-pencil-square fs-6"></i>
                                        </button>

                                        {{-- Tombol Hapus (Pemicu Modal) --}}
                                        <button type="button" class="btn btn-sm btn-light text-danger border-0" 
                                            data-bs-toggle="modal" data-bs-target="#deleteStudentModal{{ $student->id }}" title="Hapus Permanen">
                                            <i class="bi bi-trash3 fs-6"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            {{-- Include Modal Edit --}}
                            @include('admin.students._edit_modal', ['student' => $student])

                            {{-- MODAL HAPUS --}}
                            <div class="modal fade" id="deleteStudentModal{{ $student->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <div class="modal-header border-0 pb-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center pt-0">
                                                <div class="text-danger mb-3">
                                                    <i class="bi bi-trash3-fill" style="font-size: 3rem;"></i>
                                                </div>
                                                <h5 class="modal-title fw-bold mb-2">Hapus Pengguna?</h5>
                                                <p class="text-muted small mb-4">
                                                    Data Pengguna <strong>"{{ $student->name }}"</strong> beserta seluruh riwayatnya akan dihapus permanen.
                                                </p>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <div class="mb-3">
                                        <i class="bi bi-people text-secondary opacity-25" style="font-size: 3rem;"></i>
                                    </div>
                                    <h6 class="fw-bold">Belum ada data Pengguna.</h6>
                                    <p class="small mb-0">Data akan muncul setelah ada Pengguna yang mendaftar atau ditambahkan manual.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            @if($students->hasPages())
                <div class="card-footer bg-white border-top-0 py-3 d-flex justify-content-end">
                    {{ $students->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Include Modal Tambah --}}
@include('admin.students._add_modal')

@endsection