@extends('layouts.admin')

@section('title', 'Manajemen Jadwal Konseling')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 fw-medium mb-1">Manajemen Jadwal Konseling</h2>
                <p class="text-muted mb-0">Kelola sesi konseling antara mahasiswa dan konselor.</p>
            </div>
            <button class="btn btn-warning text-white fw-bold" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                <i class="bi bi-plus-circle-fill me-2"></i> Tambah Jadwal
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
            <strong>Error!</strong> Gagal memproses. Pastikan semua field wajib diisi.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mahasiswa</th>
                            <th>Konselor</th>
                            <th>Jadwal</th>
                            <th>Topik</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedule)
                        <tr>
                            <td>
                                <i class="bi bi-person-fill text-warning me-1"></i>
                                {{ $schedule->user->name }}
                            </td>
                            <td>
                                <i class="bi bi-person-circle text-primary me-1"></i>
                                {{ $schedule->counselor->name }}
                            </td>
                            <td>
                                <div class="fw-medium">{{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}</div>
                                <div class="text-muted small">{{ $schedule->time }} ({{ $schedule->duration }} menit)</div>
                            </td>
                            <td class="text-muted text-truncate" style="max-width: 200px;">{{ $schedule->topic ?? '-' }}</td>
                            <td>
                                @php
                                    $statusBadge = [
                                        'scheduled' => 'bg-primary-subtle text-primary-emphasis',
                                        'completed' => 'bg-success-subtle text-success-emphasis',
                                        'cancelled' => 'bg-danger-subtle text-danger-emphasis',
                                    ];
                                    $statusText = [
                                        'scheduled' => 'Terjadwal',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                    ];
                                @endphp
                                <span class="badge {{ $statusBadge[$schedule->status] ?? 'bg-secondary' }}">
                                    {{ $statusText[$schedule->status] ?? $schedule->status }}
                                </span>
                            </td>
                            <td class="text-end">
                                @if($schedule->status == 'scheduled')
                                <form action="{{ route('admin.schedules.updateStatus', $schedule->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="btn btn-link btn-sm text-success" title="Tandai Selesai">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.schedules.updateStatus', $schedule->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="btn btn-link btn-sm text-danger" title="Batalkan">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </button>
                                </form>
                                @endif
                                
                                <button class="btn btn-link btn-sm text-primary" data-bs-toggle="modal" data-bs-target="#editScheduleModal{{ $schedule->id }}" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                
                                <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jadwal ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link btn-sm text-danger" title="Hapus">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @include('admin.schedules._edit_modal', ['schedule' => $schedule])
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada jadwal konseling.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $schedules->links() }}</div>
        </div>
    </div>
</div>

@include('admin.schedules._add_modal')
@endsection
