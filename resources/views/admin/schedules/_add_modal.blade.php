<div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.schedules.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addScheduleModalLabel">Tambah Jadwal Konseling</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Mahasiswa <span class="text-danger">*</span></label>
                        <select class="form-select" id="user_id" name="user_id" required>
                            <option value="">Pilih Mahasiswa</option>
                            @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }} - {{ $student->nim }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="time" class="form-label">Waktu <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="duration" class="form-label">Durasi (menit)</label>
                        <select class="form-select" id="duration" name="duration">
                            <option value="30">30 menit</option>
                            <option value="60" selected>60 menit</option>
                            <option value="90">90 menit</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="topic" class="form-label">Topik Konseling</label>
                        <input type="text" class="form-control" id="topic" name="topic" placeholder="Contoh: Konseling trauma">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white">Tambah Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>