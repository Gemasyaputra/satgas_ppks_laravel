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
                        {{-- TOMBOL INFO --}}
                        {{-- Logika: Jika session BUKAN chat, maka tombol ini ACTIVE --}}
                        <button class="nav-link {{ session('active_tab') == 'chat' ? '' : 'active' }}" id="nav-info-tab"
                            data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab"
                            aria-controls="nav-info"
                            aria-selected="{{ session('active_tab') == 'chat' ? 'false' : 'true' }}">
                            <i class="bi bi-info-circle-fill me-1"></i> Informasi Laporan
                        </button>

                        {{-- TOMBOL CHAT --}}
                        {{-- Logika: Jika session ADALAH chat, maka tombol ini ACTIVE --}}
                        <button class="nav-link {{ session('active_tab') == 'chat' ? 'active' : '' }}" id="nav-chat-tab"
                            data-bs-toggle="tab" data-bs-target="#nav-chat" type="button" role="tab"
                            aria-controls="nav-chat"
                            aria-selected="{{ session('active_tab') == 'chat' ? 'true' : 'false' }}">
                            <i class="bi bi-chat-dots-fill me-1"></i> Chat dengan Satgas
                        </button>
                    </div>
                </nav>
            </div>
            <div class="card-body p-0">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade {{ session('active_tab') == 'chat' ? '' : 'show active' }} p-4" id="nav-info"
                        role="tabpanel" aria-labelledby="nav-info-tab">

                        <h5 class="fw-bold text-dark mb-2">{{ $report->title }}</h5>
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-4 border-bottom pb-3">
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
                            <span
                                class="badge {{ $statusBadge[$report->status] ?? 'bg-secondary' }} px-3 py-2 rounded-pill">
                                {{ $statusText[$report->status] ?? $report->status }}
                            </span>
                            <span
                                class="badge bg-info-subtle text-info-emphasis px-3 py-2 rounded-pill">{{ $report->category }}</span>

                            @if ($report->is_anonymous)
                                <span class="badge bg-dark-subtle text-dark-emphasis px-3 py-2 rounded-pill">
                                    <i class="bi bi-incognito me-1"></i> Pelapor Anonim
                                </span>
                            @endif

                            <small class="text-muted ms-auto">
                                <i class="bi bi-calendar-event me-1"></i> Dibuat:
                                {{ $report->created_at->format('d M Y') }}
                            </small>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="fw-bold text-primary mb-3"><i class="bi bi-geo-alt-fill me-2"></i>Detail
                                            Kejadian</h6>

                                        <div class="mb-2">
                                            <small class="text-muted d-block">Tanggal Peristiwa</small>
                                            <span
                                                class="fw-medium text-dark">{{ \Carbon\Carbon::parse($report->report_date)->format('d F Y') }}</span>
                                        </div>

                                        <div class="mb-2">
                                            <small class="text-muted d-block">Lokasi Kejadian</small>
                                            <span class="fw-medium text-dark">{{ $report->incident_location }}</span>
                                        </div>

                                        <div class="mb-2">
                                            <small class="text-muted d-block">Jenis Kekerasan</small>
                                            <span class="fw-medium text-dark">{{ $report->violence_type }}</span>
                                        </div>

                                        <div class="mb-0">
                                            <small class="text-muted d-block">Status Disabilitas Korban</small>
                                            <span class="fw-medium text-dark">{{ $report->disability_status }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <h6 class="fw-bold text-danger mb-3"><i
                                                class="bi bi-person-exclamation me-2"></i>Terlapor & Saksi</h6>

                                        <div class="mb-2">
                                            <small class="text-muted d-block">Nama Terlapor (Pelaku)</small>
                                            <span class="fw-medium text-dark">{{ $report->reported_party_name }}</span>
                                        </div>

                                        <div class="row">
                                            <div class="col-6 mb-2">
                                                <small class="text-muted d-block">Status/Pekerjaan</small>
                                                <span
                                                    class="fw-medium text-dark">{{ $report->reported_party_occupation }}</span>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <small class="text-muted d-block">Perkiraan Usia</small>
                                                <span class="fw-medium text-dark">{{ $report->reported_party_age }}
                                                    Tahun</span>
                                            </div>
                                        </div>

                                        <hr class="my-2 border-secondary-subtle">

                                        <div class="mb-0">
                                            <small class="text-muted d-block">Kontak Saksi</small>
                                            <span class="fw-medium text-dark">{{ $report->witness_contact }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (!$report->is_anonymous && $report->reporter_name)
                            <div class="card border-primary-subtle mb-4">
                                <div class="card-body bg-primary-subtle bg-opacity-10">
                                    <h6 class="fw-bold text-primary mb-3"><i
                                            class="bi bi-person-vcard-fill me-2"></i>Identitas Pelapor (Anda)</h6>
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <small class="text-muted d-block">Nama Lengkap</small>
                                            <span class="fw-medium">{{ $report->reporter_name }}</span>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <small class="text-muted d-block">Prodi / NIM</small>
                                            <span class="fw-medium">{{ $report->reporter_prodi }} /
                                                {{ $report->reporter_nim }}</span>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <small class="text-muted d-block">Kontak</small>
                                            <span class="fw-medium">{{ $report->reporter_phone }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mb-4">
                            <h6 class="text-muted small text-uppercase fw-bold border-bottom pb-1 mb-2">Kronologi Lengkap
                            </h6>
                            <div class="p-3 bg-light rounded border-start border-4 border-warning">
                                <p class="text-dark mb-0" style="white-space: pre-wrap;">{{ $report->description }}</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted small text-uppercase fw-bold border-bottom pb-1 mb-2">Alasan Melapor
                                </h6>
                                <p class="text-dark bg-light p-2 rounded small">{{ $report->reason_for_reporting }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted small text-uppercase fw-bold border-bottom pb-1 mb-2">Kebutuhan
                                    Korban</h6>
                                <p class="text-dark bg-light p-2 rounded small">{{ $report->victim_needs }}</p>
                            </div>
                        </div>

                        <div class="alert alert-secondary border-0 d-flex gap-3" role="alert">
                            <i class="bi bi-info-circle-fill fs-4 mt-1"></i>
                            <div>
                                <h6 class="alert-heading fw-bold mb-1">Catatan Admin / Satgas:</h6>
                                <p class="mb-0" style="white-space: pre-wrap;">
                                    {{ $report->admin_notes ?? 'Belum ada catatan atau update terbaru dari admin mengenai laporan ini.' }}
                                </p>
                            </div>
                        </div>

                    </div>

                    {{-- Tambahkan logika pada class: show active --}}
                    <div class="tab-pane fade {{ session('active_tab') == 'chat' ? 'show active' : '' }}" id="nav-chat"
                        role="tabpanel" aria-labelledby="nav-chat-tab">

                        @include('partials.chat_box', [
                            'report' => $report,
                            'currentUserRole' => 'student',
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Cek apakah ada session 'active_tab' bernilai 'chat' dari Controller
            @if (session('active_tab') == 'chat')
                // Ambil elemen tombol tab Chat
                const triggerEl = document.querySelector('#nav-chat-tab');

                if (triggerEl) {
                    // Panggil API Bootstrap untuk mengaktifkan tab tersebut
                    const tab = new bootstrap.Tab(triggerEl);
                    tab.show();
                }
            @endif
        });
    </script> --}}
@endsection
