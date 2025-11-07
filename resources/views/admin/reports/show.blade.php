@extends('layouts.admin')

@section('title', 'Detail Laporan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-0 pt-3">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-info-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-info" type="button" role="tab" aria-controls="nav-info"
                                    aria-selected="true">
                                    <i class="bi bi-info-circle-fill me-1"></i> Informasi Laporan
                                </button>
                                <button class="nav-link" id="nav-chat-tab" data-bs-toggle="tab" data-bs-target="#nav-chat"
                                    type="button" role="tab" aria-controls="nav-chat" aria-selected="false">
                                    <i class="bi bi-chat-dots-fill me-1"></i> Chat dengan Pelapor
                                </button>
                            </div>
                        </nav>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active p-4" id="nav-info" role="tabpanel"
                                aria-labelledby="nav-info-tab">
                                @if ($report->is_anonymous)
                                    <div class="alert alert-purple d-flex align-items-center">
                                        <i class="bi bi-shield-lock-fill fs-4 me-3"></i>
                                        <div>
                                            <h5 class="alert-heading mb-0">Laporan Anonim</h5>
                                            <p class="mb-0 small">Identitas pelapor disembunyikan untuk melindungi privasi.
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                <h5 class="fw-medium text-dark">{{ $report->title }}</h5>

                                <div class="d-flex align-items-center gap-3 my-3">
                                    <span
                                        class="badge bg-warning-subtle text-warning-emphasis fs-6">{{ $report->category }}</span>
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
                                    <span class="badge {{ $statusBadge[$report->status] ?? 'bg-secondary' }} fs-6">
                                        {{ $statusText[$report->status] ?? $report->status }}
                                    </span>
                                </div>

                                <h6 class="text-muted small text-uppercase fw-bold">Deskripsi</h6>
                                <p class="text-dark" style="white-space: pre-wrap;">{{ $report->description }}</p>

                                <h6 class="text-muted small text-uppercase fw-bold mt-4">Catatan Admin</h6>
                                <p class="text-dark" style="white-space: pre-wrap;">{{ $report->admin_notes ?? '-' }}</p>
                            </div>

                            <div class="tab-pane fade" id="nav-chat" role="tabpanel" aria-labelledby="nav-chat-tab">
                                @include('partials.chat_box', [
                                    'report' => $report,
                                    'currentUserRole' => 'admin',
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex align-items-center">
                        <i class="bi bi-person-fill me-2 fs-5 text-warning"></i>
                        <h5 class="mb-0 fw-medium">Detail Pelapor</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $report->user->photo_url ?? 'https://via.placeholder.com/60' }}"
                                alt="{{ $report->user->name }}" class="rounded-circle me-3"
                                style="width: 60px; height: 60px; object-fit: cover;">
                            <div>
                                <h5 class="fw-medium mb-0">{{ $report->is_anonymous ? 'Anonim' : $report->user->name }}</h5>
                                <span
                                    class="text-muted">{{ $report->is_anonymous ? 'Disembunyikan' : $report->user->nim }}</span>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">Email</span>
                                <span
                                    class="fw-medium">{{ $report->is_anonymous ? 'Disembunyikan' : $report->user->email }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">Telepon</span>
                                <span
                                    class="fw-medium">{{ $report->is_anonymous ? 'Disembunyikan' : $report->user->phone }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">Jurusan</span>
                                <span
                                    class="fw-medium">{{ $report->is_anonymous ? 'Disembunyikan' : $report->user->department }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">Laporan Dibuat</span>
                                <span class="fw-medium">{{ $report->created_at->format('d M Y, H:i') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">Update Terakhir</span>
                                <span class="fw-medium">{{ $report->updated_at->format('d M Y, H:i') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
