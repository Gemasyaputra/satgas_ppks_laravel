@extends('layouts.admin')

@section('title', 'Manajemen Laporan')

@section('content')
    <div class="container-fluid">

        {{-- Header Page --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4 bg-gradient-to-r from-orange-50 to-white rounded-3">
                <h2 class="h4 fw-bold text-dark mb-1">Manajemen Laporan</h2>
                <p class="text-muted mb-0 small">Kelola dan tindaklanjuti laporan pengaduan dari mahasiswa.</p>
            </div>
        </div>

        {{-- Alert Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Tabel Laporan --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary small text-uppercase">
                            <tr>
                                <th scope="col" class="ps-4 py-3 border-0 rounded-start">Pelapor</th>
                                <th scope="col" class="py-3 border-0">Kategori</th>
                                <th scope="col" class="py-3 border-0">Judul & Deskripsi</th>
                                <th scope="col" class="py-3 border-0">Tanggal</th>
                                <th scope="col" class="py-3 border-0">Status</th>
                                <th scope="col" class="text-end pe-4 py-3 border-0 rounded-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports as $report)
                                <tr>
                                    {{-- Kolom Pelapor --}}
                                    <td class="ps-4 py-3">
                                        @if ($report->is_anonymous)
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-secondary-subtle text-secondary d-flex align-items-center justify-content-center me-3"
                                                    style="width: 40px; height: 40px;">
                                                    <i class="bi bi-incognito fs-5"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark">Anonim</div>
                                                    <div class="text-muted small fst-italic">Identitas dirahasiakan</div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center me-3 fw-bold border border-primary-subtle"
                                                    style="width: 40px; height: 40px;">
                                                    {{ substr($report->user->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark">{{ Str::limit($report->user->name, 15) }}
                                                    </div>
                                                    <div class="text-muted small">{{ $report->user->nim }}</div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Kolom Kategori --}}
                                    <td>
                                        <span class="badge bg-light text-dark border fw-normal">
                                            {{ $report->category }}
                                        </span>
                                    </td>

                                    {{-- Kolom Judul & Notifikasi --}}
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bold text-dark text-truncate" style="max-width: 180px;"
                                                title="{{ $report->title }}">
                                                {{ $report->title }}
                                            </div>
                                            
                                            @if ($report->unread_messages_count > 0)
                                                <span class="badge bg-danger rounded-pill ms-2 shadow-sm"
                                                    style="font-size: 0.65rem; padding: 0.35em 0.6em;"
                                                    title="{{ $report->unread_messages_count }} Pesan Baru">
                                                    {{ $report->unread_messages_count }}
                                                </span>
                                            @endif
                                        </div>

                                        <div class="text-muted small text-truncate" style="max-width: 200px;">
                                            {{ $report->description }}
                                        </div>
                                    </td>

                                    {{-- Kolom Tanggal --}}
                                    <td class="small text-muted">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ $report->created_at->format('d M Y') }}
                                        <br>
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $report->created_at->format('H:i') }}
                                    </td>

                                    {{-- Kolom Status --}}
                                    <td>
                                        @php
                                            $badges = [
                                                'pending' =>
                                                    'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                                                'in_progress' =>
                                                    'bg-primary-subtle text-primary-emphasis border border-primary-subtle',
                                                'resolved' =>
                                                    'bg-success-subtle text-success-emphasis border border-success-subtle',
                                                'rejected' =>
                                                    'bg-danger-subtle text-danger-emphasis border border-danger-subtle',
                                            ];
                                            $labels = [
                                                'pending' => 'Menunggu',
                                                'in_progress' => 'Diproses',
                                                'resolved' => 'Selesai',
                                                'rejected' => 'Ditolak',
                                            ];
                                        @endphp
                                        <span class="badge rounded-pill {{ $badges[$report->status] }} px-3 py-1">
                                            {{ $labels[$report->status] }}
                                        </span>
                                    </td>

                                    {{-- Kolom Aksi --}}
                                    <td class="text-end pe-4">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.reports.show', $report->id) }}"
                                                class="btn btn-sm btn-light text-primary border-0" title="Lihat Detail">
                                                <i class="bi bi-eye-fill fs-6"></i>
                                            </a>

                                            <button class="btn btn-sm btn-light text-success border-0"
                                                data-bs-toggle="modal"
                                                data-bs-target="#updateReportModal{{ $report->id }}"
                                                title="Update Status">
                                                <i class="bi bi-pencil-square fs-6"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Include Modal Update Status (Per Baris) --}}
                                @include('admin.reports._update_modal', ['report' => $report])

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <div class="mb-3">
                                            <i class="bi bi-inbox text-secondary opacity-25" style="font-size: 3rem;"></i>
                                        </div>
                                        <h6 class="fw-bold">Belum ada laporan masuk.</h6>
                                        <p class="small mb-0">Laporan baru dari mahasiswa akan muncul di sini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($reports->hasPages())
                    <div class="card-footer bg-white border-top-0 py-3 d-flex justify-content-end">
                        {{ $reports->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
