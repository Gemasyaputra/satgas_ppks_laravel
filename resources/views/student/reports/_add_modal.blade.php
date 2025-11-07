<div class="modal fade" id="addReportModal" tabindex="-1" aria-labelledby="addReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('student.reports.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addReportModalLabel">Buat Laporan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori Kasus <span class="text-danger">*</span></label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="Kekerasan Verbal">Kekerasan Verbal</option>
                            <option value="Kekerasan Fisik">Kekerasan Fisik</option>
                            <option value="Pelecehan Seksual">Pelecehan Seksual</option>
                            <option value="Bullying">Bullying</option>
                            <option value="Diskriminasi">Diskriminasi</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Laporan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Ringkasan singkat kasus" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Detail <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Jelaskan kronologi, kapan, dimana, siapa yang terlibat, dll." required></textarea>
                    </div>

                    <div class="form-check form-switch p-3 bg-warning-subtle rounded border border-warning-subtle">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_anonymous" name="is_anonymous" value="1">
                        <label class="form-check-label ms-2 fw-medium text-dark" for="is_anonymous">
                            Laporkan Secara Anonim
                        </label>
                        <p class="small text-muted mb-0 mt-1">
                            Jika dicentang, identitas Anda (Nama & NIM) akan disembunyikan dari admin.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white">Kirim Laporan</button>
                </div>
            </form>
        </div>
    </div>
</div>