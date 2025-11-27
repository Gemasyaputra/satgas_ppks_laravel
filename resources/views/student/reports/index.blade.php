@extends('layouts.student')

@section('title', 'Laporan Saya')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <div class="row align-items-center">

                    <div class="col-12 col-md-8">
                        <h2 class="h4 fw-bold text-dark mb-1">Laporan Saya</h2>
                        <p class="text-muted mb-0">Laporkan kasus dengan aman dan terjaga kerahasiaannya.</p>
                    </div>

                    <div class="col-12 col-md-4 text-md-end mt-3 mt-md-0">
                        <button class="btn btn-warning text-white fw-bold shadow-sm px-4 py-2 rounded-3 w-100 w-md-auto"
                            data-bs-toggle="modal" data-bs-target="#addReportModal">
                            <i class="bi bi-plus-lg me-2"></i> Buat Laporan Baru
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row mb-4 g-3">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total Laporan</p>
                            <h3 class="fw-bold mb-0">{{ $stats['total'] }}</h3>
                        </div>
                        <i class="bi bi-file-earmark-text-fill fs-1 text-warning opacity-25"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Menunggu/Diproses</p>
                            <h3 class="fw-bold mb-0">{{ $stats['pending'] }}</h3>
                        </div>
                        <i class="bi bi-clock-history fs-1 text-primary opacity-25"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Selesai/Ditolak</p>
                            <h3 class="fw-bold mb-0">{{ $stats['resolved'] }}</h3>
                        </div>
                        <i class="bi bi-check-circle-fill fs-1 text-success opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
       @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error! Gagal mengirim laporan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

        @forelse ($reports as $report)
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body p-4">
                    <div class="row g-3 align-items-start">

                        <div class="col-12 col-md">
                            <h5 class="fw-medium text-dark mb-1 text-break">{{ $report->title }}</h5>

                            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                @php
                                    $statusBadge = [
                                        'pending' => 'bg-warning-subtle text-warning-emphasis',
                                        'in_progress' => 'bg-primary-subtle text-primary-emphasis',
                                        'resolved' => 'bg-success-subtle text-success-emphasis',
                                        'rejected' => 'bg-danger-subtle text-danger-emphasis',
                                    ];
                                    $statusText = [
                                        'pending' => 'Menunggu',
                                        'in_progress' => 'Diproses',
                                        'resolved' => 'Selesai',
                                        'rejected' => 'Ditolak',
                                    ];
                                @endphp
                                <span class="badge {{ $statusBadge[$report->status] ?? 'bg-secondary' }}">
                                    {{ $statusText[$report->status] ?? $report->status }}
                                </span>
                                <span class="badge bg-warning-subtle text-warning-emphasis">{{ $report->category }}</span>
                                @if ($report->is_anonymous)
                                    <span class="badge bg-purple-subtle text-purple-emphasis"><i
                                            class="bi bi-shield-lock-fill me-1"></i> Anonim</span>
                                @endif
                            </div>

                            <p class="text-muted mb-0">{{ Str::limit($report->description, 150) }}</p>
                        </div>

                        <div class="col-12 col-md-auto">
                            <a href="{{ route('student.reports.show', $report->id) }}"
                                class="btn btn-outline-warning btn-sm w-100 d-block d-md-inline-block">
                                <i class="bi bi-eye-fill me-1"></i> Lihat Detail
                            </a>
                        </div>

                    </div>

                    <hr class="my-2">
                    <span class="text-muted small d-block">
                        Dibuat: {{ $report->created_at->format('d M Y, H:i') }} | Update:
                        {{ $report->updated_at->format('d M Y, H:i') }}
                    </span>
                </div>
            </div>
        @empty
            <div class="card shadow-sm border-0">
                <div class="card-body text-center p-5">
                    <i class="bi bi-file-earmark-text-fill fs-1 text-muted"></i>
                    <h5 class="mt-3">Anda belum membuat laporan</h5>
                    <p class="text-muted">Klik tombol "Buat Laporan Baru" untuk memulai.</p>
                </div>
            </div>
        @endforelse

        <div class="mt-3">
            {{ $reports->links() }}
        </div>
    </div>

    @include('student.reports._add_modal')
@endsection
