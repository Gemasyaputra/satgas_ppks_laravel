@extends('layouts.student')

@section('title', 'Detail Laporan')

@section('content')
<div class="container-fluid">
    <a href="{{ route('student.reports.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Laporan
    </a>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-0 pt-3">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab" aria-controls="nav-info" aria-selected="true">
                        <i class="bi bi-info-circle-fill me-1"></i> Informasi Laporan
                    </button>
                    <button class="nav-link" id="nav-chat-tab" data-bs-toggle="tab" data-bs-target="#nav-chat" type="button" role="tab" aria-controls="nav-chat" aria-selected="false">
                        <i class="bi bi-chat-dots-fill me-1"></i> Chat dengan Satgas
                    </button>
                </div>
            </nav>
        </div>
        <div class="card-body p-0">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active p-4" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                    
                    <h5 class="fw-medium text-dark">{{ $report->title }}</h5>
                    
                    <div class="d-flex align-items-center gap-3 my-3">
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
                        <span class="badge bg-warning-subtle text-warning-emphasis fs-6">{{ $report->category }}</span>
                        @if($report->is_anonymous)
                            <span class="badge bg-purple-subtle text-purple-emphasis fs-6"><i class="bi bi-shield-lock-fill me-1"></i> Anonim</span>
                        @endif
                    </div>

                    <h6 class="text-muted small text-uppercase fw-bold">Deskripsi Laporan Anda</h6>
                    <p class="text-dark" style="white-space: pre-wrap;">{{ $report->description }}</p>

                    <h6 class="text-muted small text-uppercase fw-bold mt-4">Update / Catatan dari Admin</h6>
                    <div class="p-3 bg-light rounded border">
                        <p class="text-dark mb-0" style="white-space: pre-wrap;">{{ $report->admin_notes ?? 'Belum ada catatan dari admin.' }}</p>
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-chat" role="tabpanel" aria-labelledby="nav-chat-tab">
                    @include('partials.chat_box', ['report' => $report, 'currentUserRole' => 'student'])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection