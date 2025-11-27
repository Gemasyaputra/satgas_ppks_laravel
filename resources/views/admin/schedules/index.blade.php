@extends('layouts.admin')

@section('title', 'Manajemen Jadwal Konseling')

@section('content')
<div class="container-fluid">
    {{-- Header Halaman --}}
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

    {{-- Alert Messages --}}
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

    {{-- Tabel Data --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mahasiswa</th>
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
                                <div class="d-flex align-items-center">
                                    <div class="avatar-initial rounded bg-warning-subtle text-warning me-2 p-2">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $schedule->user->name }}</div>
                                        <div class="text-muted small" style="font-size: 0.85em;">{{ $schedule->user->nim ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-medium">{{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}</div>
                                <div class="text-muted small">
                                    <i class="bi bi-clock"></i> {{ $schedule->time }} ({{ $schedule->duration }} menit)
                                </div>
                            </td>
                            <td class="text-muted text-truncate" style="max-width: 200px;">
                                {{ $schedule->topic ?? '-' }}
                            </td>
                            <td>
                                @php
                                    $statusBadge = [
                                        'pending' => 'bg-warning-subtle text-warning-emphasis',
                                        'scheduled' => 'bg-primary-subtle text-primary-emphasis',
                                        'completed' => 'bg-success-subtle text-success-emphasis',
                                        'cancelled' => 'bg-danger-subtle text-danger-emphasis',
                                        'rejected' => 'bg-secondary-subtle text-secondary-emphasis',
                                    ];
                                    $statusText = [
                                        'pending' => 'Menunggu',
                                        'scheduled' => 'Terjadwal',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                        'rejected' => 'Ditolak',
                                    ];
                                @endphp
                                <span class="badge {{ $statusBadge[$schedule->status] ?? 'bg-secondary' }}">
                                    {{ $statusText[$schedule->status] ?? $schedule->status }}
                                </span>
                            </td>
                            <td class="text-end">
                                {{-- Tombol Aksi Cepat (Selesai/Batal) --}}
                                @if($schedule->status == 'scheduled')
                                <form action="{{ route('admin.schedules.updateStatus', $schedule->id) }}" method="POST" class="d-inline">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="btn btn-link btn-sm text-success" title="Tandai Selesai">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.schedules.updateStatus', $schedule->id) }}" method="POST" class="d-inline">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="btn btn-link btn-sm text-danger" title="Batalkan">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </button>
                                </form>
                                @endif
                                
                                {{-- Tombol Edit (Memicu Modal di Bawah) --}}
                                <button class="btn btn-link btn-sm text-primary" data-bs-toggle="modal" data-bs-target="#editScheduleModal{{ $schedule->id }}" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                
                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jadwal ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link btn-sm text-danger" title="Hapus">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        {{-- MODAL EDIT (Disisipkan langsung agar tombol Edit berfungsi) --}}
                        <div class="modal fade" id="editScheduleModal{{ $schedule->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Jadwal</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            {{-- Input Mahasiswa (Readonly agar tidak tertukar) --}}
                                            <div class="mb-3">
                                                <label class="form-label text-muted small">Mahasiswa</label>
                                                <input type="text" class="form-control bg-light" value="{{ $schedule->user->name }}" readonly>
                                                <input type="hidden" name="user_id" value="{{ $schedule->user_id }}">
                                            </div>

                                            {{-- Input Tanggal & Waktu --}}
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <label class="form-label">Tanggal</label>
                                                    <input type="date" class="form-control" name="date" value="{{ $schedule->date }}" required>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Waktu</label>
                                                    <input type="time" class="form-control" name="time" value="{{ $schedule->time }}" required>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Durasi (Menit)</label>
                                                <select class="form-select" name="duration">
                                                    <option value="30" {{ $schedule->duration == '30' ? 'selected' : '' }}>30 Menit</option>
                                                    <option value="60" {{ $schedule->duration == '60' ? 'selected' : '' }}>60 Menit</option>
                                                    <option value="90" {{ $schedule->duration == '90' ? 'selected' : '' }}>90 Menit</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Topik</label>
                                                <input type="text" class="form-control" name="topic" value="{{ $schedule->topic }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- END MODAL EDIT --}}

                        @empty
                        <tr>
                            {{-- Colspan diubah jadi 5 karena kolom Konselor dihapus --}}
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="bi bi-calendar-x fs-1 opacity-25 d-block mb-2"></i>
                                Belum ada jadwal konseling.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3 d-flex justify-content-end">
                {{ $schedules->links() }}
            </div>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH JADWAL (Pastikan code modal tambah Anda ada di file terpisah atau di bawah sini) --}}
@include('admin.schedules._add_modal')

@endsection