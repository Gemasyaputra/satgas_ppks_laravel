@extends('layouts.admin')

@section('title', 'Detail Laporan')

@section('content')
    <div class="container-fluid">

        {{-- Tombol Kembali --}}
        <a href="{{ route('admin.reports.index') }}" class="btn btn-link text-decoration-none text-secondary mb-3 ps-0">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Laporan
        </a>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                        <ul class="nav nav-tabs card-header-tabs" id="reportTabs" role="tablist">
                            
                            {{-- TAB TOMBOL 1: INFORMASI --}}
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-bold {{ session('active_tab') == 'chat' ? '' : 'active' }}" 
                                    id="info-tab" data-bs-toggle="tab"
                                    data-bs-target="#info" type="button" role="tab" 
                                    aria-selected="{{ session('active_tab') == 'chat' ? 'false' : 'true' }}">
                                    <i class="bi bi-file-text me-2"></i> Informasi Laporan
                                </button>
                            </li>

                            {{-- TAB TOMBOL 2: CHAT --}}
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-bold {{ session('active_tab') == 'chat' ? 'active' : '' }}" 
                                    id="chat-tab" data-bs-toggle="tab" data-bs-target="#chat"
                                    type="button" role="tab" 
                                    aria-selected="{{ session('active_tab') == 'chat' ? 'true' : 'false' }}">
                                    <i class="bi bi-chat-dots me-2"></i> Diskusi & Chat
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body p-0">
                        <div class="tab-content" id="reportTabsContent">

                            {{-- KONTEN TAB 1: INFORMASI --}}
                            <div class="tab-pane fade {{ session('active_tab') == 'chat' ? '' : 'show active' }} p-4" id="info" role="tabpanel">

                                {{-- Header Status & Judul --}}
                                <div class="d-flex justify-content-between align-items-start mb-4">
                                    <div>
                                        <h4 class="fw-bold text-dark mb-2">{{ $report->title }}</h4>
                                        <div class="d-flex gap-2">
                                            <span class="badge bg-light text-dark border fw-normal">
                                                <i class="bi bi-tag me-1"></i> {{ $report->category }}
                                            </span>
                                            <span class="badge bg-light text-dark border fw-normal">
                                                <i class="bi bi-calendar-event me-1"></i>
                                                {{ $report->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>

                                    @php
                                        $badges = [
                                            'pending' => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                                            'in_progress' => 'bg-primary-subtle text-primary-emphasis border border-primary-subtle',
                                            'resolved' => 'bg-success-subtle text-success-emphasis border border-success-subtle',
                                            'rejected' => 'bg-danger-subtle text-danger-emphasis border border-danger-subtle',
                                        ];
                                        $labels = [
                                            'pending' => 'Menunggu',
                                            'in_progress' => 'Diproses',
                                            'resolved' => 'Selesai',
                                            'rejected' => 'Ditolak',
                                        ];
                                    @endphp
                                    <span class="badge {{ $badges[$report->status] }} fs-6 px-3 py-2">
                                        {{ $labels[$report->status] }}
                                    </span>
                                </div>

                                {{-- GRID INFORMASI DETAIL --}}
                                <div class="row g-4">

                                    {{-- 1. Data Kejadian --}}
                                    <div class="col-md-6">
                                        <div class="card bg-light border-0 h-100">
                                            <div class="card-body">
                                                <h6 class="fw-bold text-primary mb-3"><i
                                                        class="bi bi-geo-alt-fill me-2"></i>Detail Kejadian</h6>
                                                <div class="mb-2">
                                                    <small class="text-muted d-block text-uppercase fw-bold"
                                                        style="font-size: 0.7rem;">Jenis Kekerasan</small>
                                                    <span class="fw-medium">{{ $report->violence_type }}</span>
                                                </div>
                                                <div class="mb-2">
                                                    <small class="text-muted d-block text-uppercase fw-bold"
                                                        style="font-size: 0.7rem;">Tanggal Kejadian</small>
                                                    <span
                                                        class="fw-medium">{{ \Carbon\Carbon::parse($report->report_date)->format('d F Y') }}</span>
                                                </div>
                                                <div class="mb-2">
                                                    <small class="text-muted d-block text-uppercase fw-bold"
                                                        style="font-size: 0.7rem;">Lokasi</small>
                                                    <span class="fw-medium">{{ $report->incident_location }}</span>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block text-uppercase fw-bold"
                                                        style="font-size: 0.7rem;">Status Disabilitas</small>
                                                    <span class="fw-medium">{{ $report->disability_status }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- 2. Data Terlapor --}}
                                    <div class="col-md-6">
                                        <div class="card bg-light border-0 h-100">
                                            <div class="card-body">
                                                <h6 class="fw-bold text-danger mb-3"><i
                                                        class="bi bi-person-exclamation me-2"></i>Info Terlapor</h6>
                                                <div class="mb-2">
                                                    <small class="text-muted d-block text-uppercase fw-bold"
                                                        style="font-size: 0.7rem;">Nama Terlapor</small>
                                                    <span class="fw-medium">{{ $report->reported_party_name }}</span>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <small class="text-muted d-block text-uppercase fw-bold"
                                                            style="font-size: 0.7rem;">Status/Pekerjaan</small>
                                                        <span
                                                            class="fw-medium">{{ $report->reported_party_occupation }}</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <small class="text-muted d-block text-uppercase fw-bold"
                                                            style="font-size: 0.7rem;">Usia</small>
                                                        <span class="fw-medium">{{ $report->reported_party_age }}
                                                            Tahun</span>
                                                    </div>
                                                </div>
                                                <hr class="border-secondary opacity-25 my-2">
                                                <div>
                                                    <small class="text-muted d-block text-uppercase fw-bold"
                                                        style="font-size: 0.7rem;">Saksi</small>
                                                    <span class="fw-medium">{{ $report->witness_contact }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- 3. Kronologi & Alasan --}}
                                    <div class="col-12">
                                        <h6 class="text-muted small text-uppercase fw-bold border-bottom pb-2 mb-3">
                                            Kronologi Lengkap</h6>
                                        <div class="p-3 bg-light rounded border-start border-4 border-warning">
                                            <p class="text-dark mb-0" style="white-space: pre-wrap; line-height: 1.6;">
                                                {{ $report->description }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h6 class="text-muted small text-uppercase fw-bold border-bottom pb-2 mb-2">Alasan
                                            Melapor</h6>
                                        <p class="mb-0">{{ $report->reason_for_reporting }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-muted small text-uppercase fw-bold border-bottom pb-2 mb-2">
                                            Kebutuhan Korban</h6>
                                        <p class="mb-0">{{ $report->victim_needs }}</p>
                                    </div>

                                </div>
                            </div>

                            {{-- KONTEN TAB 2: CHAT --}}
                            <div class="tab-pane fade {{ session('active_tab') == 'chat' ? 'show active' : '' }}" id="chat" role="tabpanel">
                                @include('partials.chat_box', [
                                    'report' => $report,
                                    'currentUserRole' => 'admin',
                                ])
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: DETAIL PELAPOR & TINDAKAN --}}
            <div class="col-lg-4">

                {{-- Kartu Detail Pelapor --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white fw-bold py-3">
                        <i class="bi bi-person-badge me-2 text-primary"></i> Data Pelapor
                    </div>
                    <div class="card-body">
                        @if ($report->is_anonymous)
                            <div class="text-center py-4">
                                <div class="bg-secondary-subtle rounded-circle p-3 d-inline-block mb-2">
                                    <i class="bi bi-incognito fs-1 text-secondary"></i>
                                </div>
                                <h5 class="fw-bold text-dark">Anonim</h5>
                                <p class="text-muted small mb-0">Identitas pelapor dirahasiakan.</p>
                            </div>
                        @else
                            <div class="text-center mb-4">
                                <img src="{{ $report->user->photo_url ?? 'https://via.placeholder.com/80' }}"
                                    class="rounded-circle mb-2 border p-1"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                <h5 class="fw-bold mb-0">{{ $report->user->name }}</h5>
                                <span class="badge bg-light text-dark border mt-1">{{ $report->user->nim }}</span>
                            </div>
                            <ul class="list-group list-group-flush small">
                                <li class="list-group-item px-0">
                                    <span class="text-muted">Email:</span> <br>
                                    <span class="fw-medium text-dark">{{ $report->user->email }}</span>
                                </li>
                                <li class="list-group-item px-0">
                                    <span class="text-muted">No. HP:</span> <br>
                                    <span class="fw-medium text-dark">{{ $report->user->phone ?? '-' }}</span>
                                </li>
                                <li class="list-group-item px-0">
                                    <span class="text-muted">Jurusan:</span> <br>
                                    <span class="fw-medium text-dark">{{ $report->user->department }}</span>
                                </li>
                                {{-- Data Tambahan dari Form Laporan --}}
                                <li class="list-group-item px-0">
                                    <span class="text-muted">Tempat/Tgl Lahir:</span> <br>
                                    <span class="fw-medium text-dark">{{ $report->reporter_pob }},
                                        {{ \Carbon\Carbon::parse($report->reporter_dob)->format('d M Y') }}</span>
                                </li>
                                <li class="list-group-item px-0">
                                    <span class="text-muted">Alamat Domisili:</span> <br>
                                    <span class="fw-medium text-dark">{{ $report->reporter_address }}</span>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>

                {{-- Kartu Tindakan Admin --}}
                <div class="card shadow-sm border-0 bg-warning-subtle">
                    <div class="card-body">
                        <h6 class="fw-bold text-dark mb-3">Tindakan Admin</h6>

                        <div class="mb-3">
                            <label class="small text-muted fw-bold text-uppercase">Catatan Saat Ini</label>
                            <div class="p-2 bg-white rounded border text-dark small">
                                {{ $report->admin_notes ?? 'Belum ada catatan.' }}
                            </div>
                        </div>

                        <button class="btn btn-primary w-100 fw-bold" data-bs-toggle="modal"
                            data-bs-target="#updateReportModal{{ $report->id }}">
                            <i class="bi bi-pencil-square me-1"></i> Update Status & Catatan
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Include Modal Update --}}
    @include('admin.reports._update_modal', ['report' => $report])

@endsection