@extends('layouts.admin')

@section('title', 'Manajemen Layanan')

@section('content')
<div class="container-fluid">
    
    {{-- Header Page --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4 d-flex justify-content-between align-items-center bg-gradient-to-r from-orange-50 to-white rounded-3">
            <div>
                <h2 class="h4 fw-bold text-dark mb-1">Manajemen Layanan</h2>
                <p class="text-muted mb-0 small">Kelola informasi kontak dan layanan yang tampil di halaman publik.</p>
            </div>
            {{-- <button class="btn btn-warning text-white fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                <i class="bi bi-plus-lg me-2"></i> Tambah Layanan
            </button> --}}
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Grid Layanan --}}
    <div class="row g-4">
        @forelse ($services as $service)
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0 h-100 transition-hover hover-shadow-lg">
                <div class="card-body p-4 d-flex flex-column">
                    
                    {{-- Header Kartu (Icon & Title) --}}
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box p-3 bg-warning-subtle text-warning rounded-4 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            {{-- Logika Icon Font --}}
                            @php
                                $iconClass = match($service->icon) {
                                    'email', 'mail', 'envelope' => 'envelope-fill',
                                    'instagram', 'ig' => 'instagram',
                                    'chat' => 'chat-dots-fill',
                                    default => 'telephone-fill'
                                };
                            @endphp
                            <i class="bi bi-{{ $iconClass }} fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0 text-truncate" style="max-width: 200px;">{{ $service->title }}</h5>
                            <span class="badge bg-light text-secondary border mt-1 fw-normal">
                                {{ ucfirst($service->color) }} Theme
                            </span>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <p class="text-muted small flex-grow-1 mb-3 line-clamp-2">
                        {{ Str::limit($service->description, 100) }}
                    </p>

                    {{-- Info Kontak (Phone/Email) --}}
                    <div class="mb-4 p-2 bg-light rounded border d-flex align-items-center">
                        <i class="bi bi-link-45deg text-muted me-2 fs-5"></i>
                        <span class="text-dark fw-medium text-truncate small user-select-all">
                            {{ $service->phone }}
                        </span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="mt-auto pt-3 border-top d-flex gap-2">
                        <button class="btn btn-sm btn-light text-primary fw-bold flex-fill" data-bs-toggle="modal" data-bs-target="#editServiceModal{{ $service->id }}">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </button>
                        
                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline flex-fill" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-light text-danger fw-bold w-100">
                                <i class="bi bi-trash3 me-1"></i> Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        
        {{-- Include Modal Edit di dalam loop (atau pindahkan keluar jika pakai JS dinamis) --}}
        @include('admin.services._edit_modal', ['service' => $service])

        @empty
        <div class="col-12">
            <div class="card shadow-sm border-0 bg-light border-dashed">
                <div class="card-body text-center p-5">
                    <div class="bg-white p-3 rounded-circle d-inline-block shadow-sm mb-3">
                        <i class="bi bi-grid-1x2 text-muted fs-1"></i>
                    </div>
                    <h5 class="fw-bold text-dark mt-2">Belum ada layanan</h5>
                    <p class="text-muted mb-4">Layanan yang Anda tambahkan akan muncul di halaman depan website.</p>
                    <button class="btn btn-warning text-white fw-bold" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                        <i class="bi bi-plus-lg me-1"></i> Buat Layanan Pertama
                    </button>
                </div>
            </div>
        </div>
        @endforelse
    </div>
    
    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-end">
        {{ $services->links() }}
    </div>
</div>

{{-- Modal Tambah (Hanya satu di luar loop) --}}
@include('admin.services._add_modal')

@endsection