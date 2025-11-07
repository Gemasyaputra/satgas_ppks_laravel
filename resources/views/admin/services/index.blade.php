@extends('layouts.admin')

@section('title', 'Manajemen Layanan')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 fw-medium mb-1">Manajemen Layanan</h2>
                <p class="text-muted mb-0">Kelola layanan yang ditampilkan di halaman publik.</p>
            </div>
            <button class="btn btn-warning text-white fw-bold" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                <i class="bi bi-plus-circle-fill me-2"></i> Tambah Layanan
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @forelse ($services as $service)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-inline-flex p-3 bg-warning-subtle text-warning rounded-circle me-3">
                            <i class="bi bi-{{ $service->icon ?? 'telephone-fill' }} fs-2"></i>
                        </div>
                        <h5 class="fw-medium text-dark mb-0">{{ $service->title }}</h5>
                    </div>
                    <p class="text-muted">{{ $service->description }}</p>
                    <span class="badge bg-dark-subtle text-dark-emphasis p-2 fs-6">
                        {{ $service->phone }}
                    </span>

                    <hr>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal{{ $service->id }}">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </button>
                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash3-fill me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('admin.services._edit_modal', ['service' => $service])

        @empty
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center p-5">
                    <i class="bi bi-question-circle-fill fs-1 text-muted"></i>
                    <h5 class="mt-3">Belum ada layanan</h5>
                    <p class="text-muted">Klik "Tambah Layanan" untuk membuat layanan pertama Anda.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>
    
    <div class="mt-3">
        {{ $services->links() }}
    </div>
</div>

@include('admin.services._add_modal')
@endsection