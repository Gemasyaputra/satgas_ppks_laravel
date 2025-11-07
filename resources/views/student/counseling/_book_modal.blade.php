<div class="modal fade" id="bookCounselingModal" tabindex="-1" aria-labelledby="bookCounselingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('student.counseling.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="bookCounselingModalLabel">Booking Konseling Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="counselor_id_book" class="form-label">Pilih Konselor <span class="text-danger">*</span></label>
                        <select class="form-select" id="counselor_id_book" name="counselor_id" required>
                            <option value="">Pilih konselor...</option>
                            @foreach($counselors as $counselor)
                            <option value="{{ $counselor->id }}">{{ $counselor->name }} - {{ $counselor->specialization }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="date_book" class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date_book" name="date" min="{{ now()->addDay()->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="time_book" class="form-label">Waktu <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="time_book" name="time" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="duration_book" class="form-label">Durasi Sesi</label>
                        <select class="form-select" id="duration_book" name="duration">
                            <option value="30">30 menit</option>
                            <option value="60" selected>60 menit</option>
                            <option value="90">90 menit</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="topic_book" class="form-label">Topik Konseling (Opsional)</label>
                        <input type="text" class="form-control" id="topic_book" name="topic" placeholder="Contoh: Masalah kecemasan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white">Booking Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>