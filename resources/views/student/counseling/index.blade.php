@extends('layouts.student')

@section('title', 'Jadwal Pemeriksaan')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-4 bg-warning-subtle text-warning-emphasis">
            <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
                
                <div class="d-flex flex-column flex-md-row align-items-center text-center text-md-start mb-3 mb-md-0">
                    <div class="bg-white bg-opacity-50 rounded-circle p-3 me-md-3 mb-3 mb-md-0 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                        <i class="bi bi-calendar-check-fill fs-2"></i>
                    </div>
                    <div>
                        <h2 class="h4 fw-bold mb-1">Jadwal Pemeriksaan</h2>
                        <p class="text-dark opacity-75 mb-0">Booking dan kelola sesi Pemeriksaan Anda di sini.</p>
                    </div>
                </div>

                <button class="btn btn-warning text-white fw-bold shadow-sm w-100 w-md-auto" data-bs-toggle="modal"
                    data-bs-target="#bookCounselingModal">
                    <i class="bi bi-plus-lg me-2"></i> Booking Pemeriksaan
                </button>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                <strong>Error!</strong> Gagal booking. Periksa kembali isian Anda.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h3 class="h5 fw-bold text-dark mb-3 border-bottom pb-2">Jadwal Mendatang</h3>
        
        @if ($upcomingSchedules->isEmpty())
            <div class="card shadow-sm border-0 mb-4 bg-light">
                <div class="card-body text-center p-5 text-muted">
                    <div class="bg-white p-3 rounded-circle d-inline-block shadow-sm mb-3">
                        <i class="bi bi-calendar-x fs-1 text-secondary"></i>
                    </div>
                    <p class="mt-2 fw-medium">Belum ada jadwal mendatang.</p>
                    <button class="btn btn-link text-decoration-none fw-bold text-warning" data-bs-toggle="modal" data-bs-target="#bookCounselingModal">
                        Buat Jadwal Baru
                    </button>
                </div>
            </div>
        @else
            <div class="row g-3">
            @foreach ($upcomingSchedules as $schedule)
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                @if($schedule->status == 'pending')
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-2 rounded-pill">
                                        <i class="bi bi-hourglass-split me-1"></i> Menunggu
                                    </span>
                                @else
                                    <span class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle px-3 py-2 rounded-pill">
                                        <i class="bi bi-check-circle-fill me-1"></i> Terjadwal
                                    </span>
                                @endif
                                
                                <form action="{{ route('student.counseling.cancel', $schedule->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin membatalkan jadwal ini?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-link text-danger p-0 text-decoration-none" title="Batalkan Jadwal">
                                        <i class="bi bi-trash fs-5"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Konselor</small>
                                <span class="fw-bold text-dark fs-5">
                                    {{ $schedule->counselor?->name ?? 'Menunggu Penugasan' }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Topik</small>
                                <p class="mb-0 text-secondary">{{ Str::limit($schedule->topic ?? 'Pemeriksaan Umum', 50) }}</p>
                            </div>
                            
                            <div class="mt-auto pt-3 border-top d-flex justify-content-between text-muted small">
                                <span><i class="bi bi-calendar-event me-1 text-warning"></i> {{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}</span>
                                <span><i class="bi bi-clock me-1 text-warning"></i> {{ $schedule->time }} WIB</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @endif

        <h3 class="h5 fw-bold text-dark mt-5 mb-3 border-bottom pb-2">Riwayat Pemeriksaan</h3>
        
        @if ($pastSchedules->isEmpty())
            <div class="card shadow-sm border-0 bg-light">
                <div class="card-body text-center p-5 text-muted">
                    <i class="bi bi-clock-history fs-1 text-secondary opacity-50"></i>
                    <p class="mt-2">Belum ada riwayat Pemeriksaan.</p>
                </div>
            </div>
        @else
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-nowrap">
                        <thead class="bg-light text-secondary small text-uppercase">
                            <tr>
                                <th class="ps-4 py-3">Tanggal</th>
                                <th class="py-3">Konselor</th>
                                <th class="py-3">Status</th>
                                <th class="pe-4 py-3 text-end">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($pastSchedules as $schedule)
                            <tr>
                                <td class="ps-4 fw-medium text-dark">
                                    {{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}
                                </td>
                                <td>
                                    {{ $schedule->counselor?->name ?? '-' }}
                                </td>
                                <td>
                                    @if ($schedule->status == 'completed')
                                        <span class="badge bg-success-subtle text-success-emphasis rounded-pill">Selesai</span>
                                    @elseif ($schedule->status == 'cancelled')
                                        <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill">Dibatalkan User</span>
                                    @elseif ($schedule->status == 'rejected')
                                        <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill">Ditolak Satgas</span>
                                    @else
                                        <span class="badge bg-light text-dark border">{{ $schedule->status }}</span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end text-muted small">
                                    {{ $schedule->time }} WIB
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    @include('student.counseling._book_modal')
@endsection