@extends('layouts.student')

@section('title', 'Beranda Mahasiswa')

@section('content')
    <div class="container-fluid">
        <div class="card bg-warning-subtle border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="h5 fw-bold mb-1">Selamat datang, {{ Auth::user()->name }} 👋</h2>
                        <p class="text-muted mb-0">Kami hadir untuk mendukung kenyamanan dan keamanan mahasiswa PNP.</p>
                    </div>
                    <i class="bi bi-shield-check fs-1 text-warning opacity-50 d-none d-md-block"></i>
                </div>
            </div>
        </div>

        <div class="row mb-4 g-3">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small text-uppercase fw-bold">Laporan Diproses</p>
                            <h3 class="fw-bold mb-0 text-dark">{{ $stats['pending_reports'] }}</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 60px; height: 60px;">
                            <i class="bi bi-file-earmark-medical-fill fs-4 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small text-uppercase fw-bold">Jadwal Pemeriksaan</p>
                            <h3 class="fw-bold mb-0 text-dark">{{ $stats['upcoming_schedules'] }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 60px; height: 60px;">
                            <i class="bi bi-calendar-check-fill fs-4 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small text-uppercase fw-bold">Sesi Selesai</p>
                            <h3 class="fw-bold mb-0 text-dark">{{ $stats['completed_schedules'] }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 60px; height: 60px;">
                            <i class="bi bi-check-circle-fill fs-4 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7">

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                        <h5 class="mb-0 fw-bold">Laporan Terbaru Anda</h5>
                    </div>
                    <div class="card-body p-3">
                        @forelse ($recentReports as $report)
                            <div
                                class="d-flex justify-content-between align-items-center p-3 rounded hover-bg-light {{ !$loop->last ? 'border-bottom' : '' }}">
                                <div class="overflow-hidden me-3"> <a
                                        href="{{ route('student.reports.show', $report->id) }}"
                                        class="fw-bold text-dark text-decoration-none d-block text-truncate">
                                        {{ $report->title }}
                                    </a>
                                    <span class="text-muted small">{{ $report->category }} &bull;
                                        {{ $report->created_at->diffForHumans() }}</span>
                                </div>

                                @php
                                    $badges = [
                                        'pending' => ['warning', 'Menunggu'],
                                        'in_progress' => ['primary', 'Diproses'],
                                        'resolved' => ['success', 'Selesai'],
                                        'rejected' => ['danger', 'Ditolak'],
                                    ];
                                    [$color, $label] = $badges[$report->status] ?? ['secondary', $report->status];
                                @endphp
                                <span
                                    class="badge bg-{{ $color }}-subtle text-{{ $color }}-emphasis rounded-pill text-nowrap">
                                    {{ $label }}
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <i class="bi bi-clipboard-x text-muted fs-1"></i>
                                <p class="text-muted mt-2">Belum ada laporan.</p>
                            </div>
                        @endforelse

                        @if ($recentReports->count() > 0)
                            <div class="d-grid px-2 mt-2">
                                <a href="{{ route('student.reports.index') }}"
                                    class="btn btn-light text-muted small fw-bold">Lihat Semua Laporan <i
                                        class="bi bi-arrow-right ms-1"></i></a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card-body p-3">
                    @forelse ($upcomingCounseling as $schedule)
                        <div
                            class="d-flex justify-content-between align-items-center p-3 rounded {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div>
                                <span class="fw-bold text-dark d-block">
                                    @if ($schedule->counselor)
                                        Pemeriksaan dgn {{ $schedule->counselor->name }}
                                    @else
                                        <span class="fst-italic text-muted">Menunggu Penugasan</span>
                                    @endif
                                </span>

                                <p class="text-muted small mb-0">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}, {{ $schedule->time }}
                                </p>
                            </div>

                            @if ($schedule->status == 'pending')
                                <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill">
                                    <i class="bi bi-hourglass-split me-1"></i> Menunggu
                                </span>
                            @else
                                <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill">
                                    <i class="bi bi-check-circle-fill me-1"></i> Terjadwal
                                </span>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="bi bi-calendar-x text-muted fs-1"></i>
                            <p class="text-muted mt-2">Tidak ada jadwal Pemeriksaan.</p>
                        </div>
                    @endforelse

                    @if ($upcomingCounseling->count() > 0)
                        <div class="d-grid px-2 mt-2">
                            <a href="{{ route('student.counseling.index') }}"
                                class="btn btn-light text-muted small fw-bold">
                                Lihat Semua Jadwal <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-5">

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                        <h5 class="mb-0 fw-bold">Artikel & Edukasi</h5>
                    </div>
                    <div class="card-body p-3">
                        @forelse ($recentArticles as $article)
                            <a href="{{ route('student.articles.show', $article->id) }}"
                                class="d-block p-3 rounded text-decoration-none bg-light mb-2">
                                <h6 class="fw-bold text-dark mb-1 text-truncate">{{ $article->title }}</h6>
                                <p class="text-muted small mb-0 text-truncate">{{ $article->excerpt }}</p>
                            </a>
                        @empty
                            <p class="text-muted text-center p-3">Belum ada artikel terbaru.</p>
                        @endforelse

                        <div class="d-grid mt-3">
                            <a href="{{ route('student.articles.index') }}"
                                class="btn btn-outline-warning btn-sm rounded-pill">Baca Artikel Lainnya</a>
                        </div>
                    </div>
                </div>

                {{-- LOGIKA PENGAMBILAN NOMOR HP --}}
                @php
                    // 1. Panggil Model Service
                    use App\Models\Service;

                    // 2. Cari layanan yang punya nomor HP.
                    // Prioritas: Cari yang icon-nya 'telephone' (biasanya hotline), kalau tidak ada ambil yang pertama saja.
                    $serviceKontak = Service::where('icon', 'telephone')->orWhereNotNull('phone')->first();

                    // 3. Ambil nomornya, default ke dummy jika kosong
                    $rawPhone = $serviceKontak ? $serviceKontak->phone : '6281234567890';

                    // 4. Format nomor agar sesuai format WA (Ubah 08xx jadi 628xx)
                    if (Str::startsWith($rawPhone, '0')) {
                        $waNumber = '62' . substr($rawPhone, 1);
                    } else {
                        $waNumber = $rawPhone;
                    }
                @endphp

                {{-- TAMPILAN KARTU --}}
                <div class="card shadow-sm border-0 text-white mt-3 mx-2"
                    style="background: linear-gradient(45deg, #fd7e14, #ff7207); border-radius: 1rem;">
                    <div class="card-body p-4 text-center">
                        <div class="bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="bi bi-telephone-fill fs-3 text-white"></i>
                        </div>

                        <h6 class="fw-bold mb-1">Butuh Bantuan?</h6>
                        <p class="small opacity-75 mb-3" style="font-size: 0.75rem;">
                            Hubungi Satgas segera jika dalam keadaan darurat.
                        </p>

                        {{-- LINK WA DINAMIS --}}
                        <a href="https://wa.me/{{ $waNumber }}" target="_blank"
                            class="btn btn-light btn-sm fw-bold w-100 shadow-sm rounded-pill" style="color: #fd7e14;">
                            <i class="bi bi-whatsapp me-1"></i> Hubungi Satgas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
