<div class="modal fade" id="updateReportModal{{ $report->id }}" tabindex="-1" aria-labelledby="updateReportModalLabel{{ $report->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.reports.update', $report->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="updateReportModalLabel{{ $report->id }}">Update Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="category{{ $report->id }}" class="form-label">Kategori Laporan</label>
                        <select class="form-select" id="category{{ $report->id }}" name="category" required>
                            @php
                                $categories = [
                                    'Kekerasan Psikis', 
                                    'Kekerasan Fisik', 
                                    'Pelecehan Seksual', 
                                    'Perundungan', 
                                    'Diskriminasi & intoleransi', 
                                    'kebijakan dengan unsur kekerasan',
                                    'Laporan Masuk', // Kategori default lama
                                    'Laporan Rinci'  // Kategori default baru
                                ];
                            @endphp
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ $report->category == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">Ubah kategori jika laporan tidak sesuai.</div>
                    </div>

                    <div class="mb-3">
                        <label for="status{{ $report->id }}" class="form-label">Status Laporan</label>
                        <select class="form-select" id="status{{ $report->id }}" name="status" required>
                            <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="in_progress" {{ $report->status == 'in_progress' ? 'selected' : '' }}>Diproses</option>
                            <option value="resolved" {{ $report->status == 'resolved' ? 'selected' : '' }}>Selesai</option>
                            <option value="rejected" {{ $report->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="admin_notes{{ $report->id }}" class="form-label">Catatan Admin / Tindak Lanjut</label>
                        <textarea class="form-control" id="admin_notes{{ $report->id }}" name="admin_notes" rows="4" 
                                  placeholder="Berikan catatan atau update tentang tindak lanjut laporan...">{{ $report->admin_notes }}</textarea>
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