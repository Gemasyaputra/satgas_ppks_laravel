@extends('layouts.admin')

@section('title', 'Beranda Admin')

@section('content')
<div class="container-fluid">
    
    {{-- Header Hero --}}
    <div class="card border-0 shadow-sm mb-4 overflow-hidden">
        <div class="card-body p-4 bg-gradient-to-r from-orange-50 to-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h4 fw-bold text-dark mb-1">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-muted mb-0 small">Ini adalah ringkasan aktivitas di portal Satgas PPKPT hari ini.</p>
                </div>
                <div class="d-none d-md-block">
                    <span class="badge bg-white text-orange-600 border border-orange-100 px-3 py-2 rounded-pill shadow-sm">
                        <i class="bi bi-calendar-event me-1"></i> {{ now()->isoFormat('D MMMM Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik Utama (Grid 4) --}}
    <div class="row g-3 mb-4">
        {{-- Kartu 1: Laporan Menunggu --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="icon-square bg-danger-subtle text-danger rounded-3 p-2 me-3">
                            <i class="bi bi-exclamation-circle-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted small text-uppercase fw-bold mb-0">Laporan Masuk</h6>
                            <h2 class="fw-bold text-dark mb-0">{{ $stats['reports_pending'] }}</h2>
                        </div>
                    </div>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ ($stats['reports_pending'] / max($stats['reports_total'], 1)) * 100 }}%"></div>
                    </div>
                    <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">Dari total {{ $stats['reports_total'] }} laporan</small>
                </div>
            </div>
        </div>

        {{-- Kartu 2: Mahasiswa --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="icon-square bg-primary-subtle text-primary rounded-3 p-2 me-3">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted small text-uppercase fw-bold mb-0">Mahasiswa</h6>
                            <h2 class="fw-bold text-dark mb-0">{{ $stats['students_count'] }}</h2>
                        </div>
                    </div>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 70%"></div>
                    </div>
                    <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">Akun aktif terdaftar</small>
                </div>
            </div>
        </div>

        {{-- Kartu 3: Jadwal --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="icon-square bg-success-subtle text-success rounded-3 p-2 me-3">
                            <i class="bi bi-calendar-check-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted small text-uppercase fw-bold mb-0">Jadwal Nanti</h6>
                            <h2 class="fw-bold text-dark mb-0">{{ $stats['schedules_upcoming'] }}</h2>
                        </div>
                    </div>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 50%"></div>
                    </div>
                    <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">Sesi Pemeriksaan terjadwal</small>
                </div>
            </div>
        </div>

        {{-- Kartu 4: Artikel --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="icon-square bg-info-subtle text-info-emphasis rounded-3 p-2 me-3">
                            <i class="bi bi-journal-text fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted small text-uppercase fw-bold mb-0">Artikel</h6>
                            <h2 class="fw-bold text-dark mb-0">{{ $stats['articles_count'] }}</h2>
                        </div>
                    </div>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"></div>
                    </div>
                    <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">Konten edukasi aktif</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- TABEL LAPORAN TERBARU --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Laporan Masuk Terbaru</h5>
                        <p class="text-muted small mb-0">Daftar laporan yang perlu ditinjau</p>
                    </div>
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-sm btn-light text-muted fw-bold border hover-bg-gray-100">
                        Lihat Semua
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary small text-uppercase">
                            <tr>
                                <th class="ps-4 py-3 border-0 rounded-start">Pelapor</th>
                                <th class="py-3 border-0">Kategori</th>
                                <th class="py-3 border-0">Tanggal</th>
                                <th class="py-3 border-0">Status</th>
                                <th class="text-end pe-4 py-3 border-0 rounded-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentReports as $report)
                            <tr>
                                <td class="ps-4">
                                    @if($report->is_anonymous)
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary-subtle rounded-circle p-2 me-2 text-secondary">
                                                <i class="bi bi-incognito"></i>
                                            </div>
                                            <div>
                                                <span class="fw-medium text-dark d-block">Anonim</span>
                                                <span class="small text-muted">Identitas dirahasiakan</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary-subtle rounded-circle p-2 me-2 text-primary fw-bold" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                                {{ substr($report->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <span class="fw-medium text-dark d-block">{{ Str::limit($report->user->name, 15) }}</span>
                                                <span class="small text-muted">{{ $report->user->nim }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border fw-normal">{{ Str::limit($report->category, 15) }}</span>
                                </td>
                                <td class="small text-muted">{{ $report->created_at->format('d M Y') }}</td>
                                <td>
                                    @php
                                        $badges = [
                                            'pending' => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                                            'in_progress' => 'bg-primary-subtle text-primary-emphasis border border-primary-subtle',
                                            'resolved' => 'bg-success-subtle text-success-emphasis border border-success-subtle',
                                            'rejected' => 'bg-danger-subtle text-danger-emphasis border border-danger-subtle'
                                        ];
                                        $labels = [
                                            'pending' => 'Menunggu',
                                            'in_progress' => 'Diproses',
                                            'resolved' => 'Selesai',
                                            'rejected' => 'Ditolak'
                                        ];
                                    @endphp
                                    <span class="badge rounded-pill {{ $badges[$report->status] }} px-3 py-1">
                                        {{ $labels[$report->status] }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.reports.show', $report->id) }}" class="btn btn-sm btn-light text-primary fw-bold">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <div class="mb-2"><i class="bi bi-inbox fs-1 opacity-25"></i></div>
                                    Belum ada laporan masuk saat ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- LIST JADWAL Pemeriksaan --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark">Jadwal Pemeriksaan</h5>
                    <a href="{{ route('admin.schedules.index') }}" class="btn btn-sm btn-link text-muted text-decoration-none">Lihat Semua</a>
                </div>
                <div class="card-body pt-0 px-4 pb-4">
                    <div class="list-group list-group-flush">
                        @forelse($upcomingSchedules as $schedule)
                            <div class="list-group-item border-0 px-0 py-3 d-flex gap-3 align-items-center">
                                {{-- Tanggal Box --}}
                                <div class="text-center bg-orange-50 rounded-3 p-2 border border-orange-100" style="min-width: 60px;">
                                    <div class="fw-bold text-orange-600 h5 mb-0">{{ \Carbon\Carbon::parse($schedule->date)->format('d') }}</div>
                                    <div class="small text-uppercase text-orange-400" style="font-size: 0.65rem;">{{ \Carbon\Carbon::parse($schedule->date)->format('M') }}</div>
                                </div>
                                
                                {{-- Info User & Waktu --}}
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-bold text-dark">{{ $schedule->user->name }}</h6>
                                    <div class="d-flex align-items-center gap-2 text-muted small mb-1">
                                        <span><i class="bi bi-clock me-1 text-orange-400"></i> {{ $schedule->time }}</span>
                                        <span>&bull;</span>
                                        <span>{{ $schedule->duration }} menit</span>
                                    </div>
                                    <div class="small text-muted">
                                        <i class="bi bi-person-badge me-1"></i> 
                                        {{ $schedule->counselor?->name ?? 'Belum ditentukan' }}
                                    </div>
                                </div>

                                {{-- Status Dot --}}
                                <div>
                                    @if($schedule->status == 'pending')
                                        <span class="badge bg-warning rounded-pill" title="Menunggu Konfirmasi">&nbsp;</span>
                                    @else
                                        <span class="badge bg-primary rounded-pill" title="Terjadwal">&nbsp;</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted">
                                <i class="bi bi-calendar-check fs-1 opacity-25"></i>
                                <p class="mt-3 small">Tidak ada jadwal mendatang.</p>
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="d-grid mt-3">
                        <button class="btn btn-warning text-white fw-bold shadow-sm py-2" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Jadwal Baru
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal --}}
@include('admin.schedules._add_modal', [
    'students' => \App\Models\User::where('role', 'student')->get(), 
    'counselors' => \App\Models\Counselor::where('is_active', true)->get()
])

@endsection