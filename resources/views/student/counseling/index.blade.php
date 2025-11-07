@extends('layouts.student')

@section('title', 'Jadwal Konseling')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0 mb-4 bg-warning-subtle text-warning-emphasis">
        <div class="card-body p-4 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 fw-medium mb-1">Jadwal Konseling</h2>
                <p class="text-muted mb-0">Booking dan kelola sesi konseling Anda.</p>
            </div>
            <button class="btn btn-warning text-white fw-bold" data-bs-toggle="modal" data-bs-target="#bookCounselingModal">
                <i class="bi bi-plus-circle-fill me-2"></i> Booking Konseling
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Gagal booking. Pastikan konselor, tanggal, dan waktu diisi.
            <button type="button" class_close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h3 class="h5 fw-medium mb-3">Jadwal Mendatang</h3>
    @if($upcomingSchedules->isEmpty())
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body text-center p-5 text-muted">
                <i class="bi bi-calendar-x fs-1"></i>
                <p class="mt-2">Belum ada jadwal mendatang.</p>
            </div>
        </div>
    @else
        @foreach($upcomingSchedules as $schedule)
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="badge bg-primary-subtle text-primary-emphasis mb-2">Terjadwal</span>
                        <h5 class="fw-medium text-dark mb-1">{{ $schedule->counselor->name }}</h5>
                        <p class="text-muted mb-2">{{ $schedule->topic ?? 'Konseling Umum' }}</p>
                        <div class="d-flex flex-wrap gap-3 text-muted small">
                            <span><i class="bi bi-calendar-fill me-1"></i> {{ \Carbon\Carbon::parse($schedule->date)->format('l, d M Y') }}</span>
                            <span><i class="bi bi-clock-fill me-1"></i> {{ $schedule->time }} ({{ $schedule->duration }} menit)</span>
                        </div>
                    </div>
                    <form action="{{ route('student.counseling.cancel', $schedule->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan jadwal ini?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-x-circle me-1"></i> Batalkan
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    @endif

    <h3 class="h5 fw-medium mt-5 mb-3">Riwayat Konseling</h3>
    @if($pastSchedules->isEmpty())
        <div class="card shadow-sm border-0">
            <div class="card-body text-center p-5 text-muted">
                <i class="bi bi-calendar-check fs-1"></i>
                <p class="mt-2">Belum ada riwayat konseling.</p>
            </div>
        </div>
    @else
        @foreach($pastSchedules as $schedule)
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        @if($schedule->status == 'completed')
                        <span class="badge bg-success-subtle text-success-emphasis mb-2">Selesai</span>
                        @else
                        <span class="badge bg-danger-subtle text-danger-emphasis mb-2">Dibatalkan</span>
                        @endif
                        <h5 class="fw-medium text-dark mb-1">{{ $schedule->counselor->name }}</h5>
                        <div class="d-flex flex-wrap gap-3 text-muted small">
                            <span><i class="bi bi-calendar-fill me-1"></i> {{ \Carbon\Carbon::parse($schedule->date)->format('l, d M Y') }}</span>
                            <span><i class="bi bi-clock-fill me-1"></i> {{ $schedule->time }}</span>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
        @endforeach
    @endif
</div>

@include('student.counseling._book_modal')
@endsection