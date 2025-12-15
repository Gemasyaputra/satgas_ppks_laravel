<div class="modal fade" id="bookCounselingModal" tabindex="-1" aria-labelledby="bookCounselingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('student.counseling.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="bookCounselingModalLabel">Booking Pemeriksaan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="alert alert-info border-0 d-flex align-items-start mb-4">
                        <i class="bi bi-info-circle-fill me-2 mt-1"></i>
                        <div class="small lh-sm">
                            <strong>Catatan:</strong> Konselor akan ditentukan oleh tim Satgas PPKPT sesuai dengan ketersediaan dan kebutuhan Anda.
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="date_book" class="form-label small fw-bold">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control bg-light border-0" id="date_book" name="date" min="{{ now()->addDay()->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="time_book" class="form-label small fw-bold">Waktu <span class="text-danger">*</span></label>
                            <input type="time" class="form-control bg-light border-0" id="time_book" name="time" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="duration_book" class="form-label small fw-bold">Durasi Sesi</label>
                        <select class="form-select bg-light border-0" id="duration_book" name="duration">
                            <option value="30">30 menit</option>
                            <option value="60" selected>60 menit</option>
                            <option value="90">90 menit</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="topic_book" class="form-label small fw-bold">Topik Pemeriksaan (Opsional)</label>
                        <textarea class="form-control bg-light border-0" id="topic_book" name="topic" rows="2" placeholder="Contoh: Saya merasa cemas menghadapi ujian akhir..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-light fw-medium" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white fw-bold shadow-sm">Booking Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>