@extends('layouts.admin')

@section('title', 'Manajemen Konselor')

@section('content')
<div class="container-fluid">
    
    {{-- Header Page --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4 d-flex justify-content-between align-items-center bg-gradient-to-r from-orange-50 to-white rounded-3">
            <div>
                <h2 class="h4 fw-bold text-dark mb-1">Manajemen Tim Satgas</h2>
                <p class="text-muted mb-0 small">Kelola data anggota Satgas (mahasiswa dan tenaga pendidik).</p>
            </div>
            <button class="btn btn-warning text-white fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#addCounselorModal">
                <i class="bi bi-plus-lg me-2"></i> Tambah Konselor
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

    {{-- Tabel Konselor --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary small text-uppercase">
                        <tr>
                            <th scope="col" class="ps-4 py-3 border-0 rounded-start">Anggota Satgas</th>
                            <th scope="col" class="py-3 border-0">Peran</th>
                            <th scope="col" class="py-3 border-0">Spesialisasi</th>
                            <th scope="col" class="py-3 border-0">Kontak</th>
                            <th scope="col" class="py-3 border-0">Status</th>
                            <th scope="col" class="text-end pe-4 py-3 border-0 rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($counselors as $counselor)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        @if($counselor->photo_url)
                                            <img src="{{ asset('storage/' . $counselor->photo_url) }}" 
                                                 alt="{{ $counselor->name }}" 
                                                 class="rounded-circle object-fit-cover border" 
                                                 style="width: 45px; height: 45px;">
                                        @else
                                            {{-- Avatar Inisial --}}
                                            <div class="rounded-circle bg-orange-100 text-orange-600 d-flex align-items-center justify-content-center fw-bold border border-orange-200" 
                                                 style="width: 45px; height: 45px; font-size: 1.1rem;">
                                                {{ substr($counselor->name, 0, 1) }}
                                            </div>
                                        @endif
                                        
                                        <div class="ms-3">
                                            <div class="fw-bold text-dark">{{ $counselor->name }}</div>
                                            <div class="text-muted small" style="font-size: 0.8rem;">{{ $counselor->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{-- PERBAIKAN DISINI: Ganti Purple jadi Primary (Oranye) atau Secondary (Abu) --}}
                                    @if($counselor->role == 'Mahasiswa Satgas')
                                        <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle rounded-pill px-3">
                                            <i class="bi bi-mortarboard-fill me-1"></i> Mahasiswa
                                        </span>
                                    @else
                                        {{-- Menggunakan 'bg-primary-subtle' agar warnanya Oranye Muda (sesuai tema) --}}
                                        <span class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle rounded-pill px-3">
                                            <i class="bi bi-person-badge-fill me-1"></i> Dosen/Staff
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center text-secondary">
                                        <i class="bi bi-stars text-warning me-2"></i>
                                        <span>{{ $counselor->specialization }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center text-secondary">
                                        <i class="bi bi-whatsapp text-success me-2"></i>
                                        <span class="font-monospace small">{{ $counselor->phone }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($counselor->is_active)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2">
                                            <i class="bi bi-check-circle-fill me-1"></i> Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2">
                                            <i class="bi bi-dash-circle me-1"></i> Non-Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-light text-primary border-0" data-bs-toggle="modal"
                                            data-bs-target="#editCounselorModal{{ $counselor->id }}" title="Edit Data">
                                            <i class="bi bi-pencil-square fs-6"></i>
                                        </button>

                                        <form action="{{ route('admin.counselors.destroy', $counselor->id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light text-danger border-0" title="Hapus">
                                                <i class="bi bi-trash3 fs-6"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            {{-- Include Modal Edit --}}
                            @include('admin.counselors._edit_modal', ['counselor' => $counselor])

                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <div class="mb-3">
                                        <i class="bi bi-people text-secondary opacity-25" style="font-size: 3rem;"></i>
                                    </div>
                                    <h6 class="fw-bold">Belum ada data anggota Satgas.</h6>
                                    <p class="small mb-0">Klik tombol tambah di atas untuk memulai.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            @if($counselors->hasPages())
                <div class="card-footer bg-white border-top-0 py-3 d-flex justify-content-end">
                    {{ $counselors->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Include Modal Tambah --}}
@include('admin.counselors._add_modal')

@endsection