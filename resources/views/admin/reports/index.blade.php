@extends('layouts.admin')

@section('title', 'Manajemen Laporan')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h2 class="h4 fw-medium mb-1">Manajemen Laporan</h2>
            <p class="text-muted mb-0">Kelola dan tindaklanjuti laporan dari mahasiswa.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Mahasiswa</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Judul Laporan</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                        <tr>
                            <td>
                                <div class="fw-medium">{{ $report->user->name }}</div>
                                <div class="text-muted small">{{ $report->user->nim }}</div>
                                @if($report->is_anonymous)
                                    <span class="badge bg-purple-subtle text-purple-emphasis small"><i class="bi bi-shield-lock-fill me-1"></i> Anonim</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-warning-subtle text-warning-emphasis">
                                    {{ $report->category }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-medium text-dark text-truncate" style="max-width: 250px;">{{ $report->title }}</div>
                                <div class="text-muted small text-truncate" style="max-width: 250px;">{{ $report->description }}</div>
                            </td>
                            <td class="text-muted small">{{ $report->created_at->format('d M Y, H:i') }}</td>
                            <td>
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
                                <span class="badge {{ $statusBadge[$report->status] ?? 'bg-secondary' }}">
                                    {{ $statusText[$report->status] ?? $report->status }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.reports.show', $report->id) }}" class="btn btn-link btn-sm text-secondary" title="Lihat Detail">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <button class="btn btn-link btn-sm text-primary" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#updateReportModal{{ $report->id }}"
                                        title="Update Status">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                        </tr>

                        @include('admin.reports._update_modal', ['report' => $report])
                        
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada laporan yang masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $reports->links() }}
            </div>
        </div>
    </div>
</div>
@endsection