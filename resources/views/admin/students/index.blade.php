@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="container-fluid">
    
    {{-- Header Page --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4 d-flex justify-content-between align-items-center bg-gradient-to-r from-orange-50 to-white rounded-3">
            <div>
                <h2 class="h4 fw-bold text-dark mb-1">Manajemen Pengguna</h2>
                <p class="text-muted mb-0 small">Kelola seluruh data pengguna (Mahasiswa, Tenaga Pendidik, dll).</p>
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
            <strong>Terjadi Kesalahan!</strong>
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
                            <th scope="col" class="py-3 border-0">Peran (Role)</th>
                            <th scope="col" class="py-3 border-0">NIM / NIP</th>
                            <th scope="col" class="py-3 border-0">Jurusan</th>
                            <th scope="col" class="py-3 border-0">Status</th>
                            <th scope="col" class="text-end pe-4 py-3 border-0 rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Perhatikan variabelnya sekarang $users --}}
                        @forelse ($users as $user)
                            <tr>
                                {{-- Kolom Foto & Nama --}}
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        @if($user->photo_url)
                                            <img src="{{ asset('storage/' . $user->photo_url) }}" 
                                                 alt="{{ $user->name }}" 
                                                 class="rounded-circle object-fit-cover border shadow-sm" 
                                                 style="width: 45px; height: 45px;">
                                        @else
                                            <div class="rounded-circle bg-secondary-subtle text-secondary d-flex align-items-center justify-content-center fw-bold border" 
                                                 style="width: 45px; height: 45px; font-size: 1.1rem;">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                        @endif
                                        
                                        <div class="ms-3">
                                            <div class="fw-bold text-dark">{{ $user->name }}</div>
                                            <div class="text-muted small" style="font-size: 0.8rem;">
                                                <i class="bi bi-envelope me-1"></i>{{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom Role --}}
                                <td>
                                    @if($user->role == 'admin')
                                        <span class="badge bg-dark text-white border border-dark rounded-pill px-3">Admin</span>
                                    @elseif($user->role == 'student')
                                        <span class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle rounded-pill px-3">Mahasiswa</span>
                                    @else
                                        <span class="badge bg-light text-dark border rounded-pill px-3">{{ ucfirst($user->role) }}</span>
                                    @endif
                                </td>

                                {{-- Kolom NIM (Kosong jika Admin) --}}
                                <td>
                                    @if($user->nim)
                                        <span class="font-monospace text-dark fw-medium bg-light px-2 py-1 rounded border">
                                            {{ $user->nim }}
                                        </span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>

                                {{-- Kolom Jurusan --}}
                                <td class="text-secondary">
                                    @if($user->department)
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-building text-muted me-2"></i>
                                            {{ $user->department }}
                                        </div>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>

                                {{-- Kolom Status --}}
                                <td>
                                    @if($user->is_active)
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
                                        {{-- Toggle Status --}}
                                        <form action="{{ route('admin.students.toggleStatus', $user->id) }}" method="POST" class="d-inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-light border-0" 
                                                title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                <i class="bi {{ $user->is_active ? 'bi-person-fill-slash text-warning' : 'bi-person-check-fill text-success' }} fs-6"></i>
                                            </button>
                                        </form>

                                        {{-- Tombol Edit --}}
                                        <button class="btn btn-sm btn-light text-primary border-0" data-bs-toggle="modal"
                                            data-bs-target="#editStudentModal{{ $user->id }}" title="Edit Data">
                                            <i class="bi bi-pencil-square fs-6"></i>
                                        </button>

                                        {{-- Tombol Hapus --}}
                                        <button type="button" class="btn btn-sm btn-light text-danger border-0" 
                                            data-bs-toggle="modal" data-bs-target="#deleteStudentModal{{ $user->id }}" title="Hapus Permanen">
                                            <i class="bi bi-trash3 fs-6"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            {{-- MODAL EDIT DAN HAPUS --}}
                            {{-- Catatan: Pastikan _edit_modal juga diupdate variabelnya jadi $student atau $user --}}
                            {{-- Karena include di bawah pakai 'student' => $user, maka di dalam modal variabelnya tetap $student --}}
                            
                            @include('admin.students._edit_modal', ['student' => $user])

                            <div class="modal fade" id="deleteStudentModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.students.destroy', $user->id) }}" method="POST">
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
                                                    Pengguna <strong>"{{ $user->name }}"</strong> akan dihapus permanen.
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
                                    <h6 class="fw-bold">Belum ada data Pengguna.</h6>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer bg-white border-top-0 py-3 d-flex justify-content-end">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

@include('admin.students._add_modal')

@endsection