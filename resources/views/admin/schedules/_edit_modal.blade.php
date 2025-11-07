<div class="modal fade" id="editScheduleModal{{ $schedule->id }}" tabindex="-1" aria-labelledby="editScheduleModalLabel{{ $schedule->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editScheduleModalLabel{{ $schedule->id }}">Edit Jadwal Konseling</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_id_edit{{ $schedule->id }}" class="form-label">Mahasiswa</label>
                        <select class="form-select" id="user_id_edit{{ $schedule->id }}" name="user_id" required>
                            @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ $schedule->user_id == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="counselor_id_edit{{ $schedule->id }}" class="form-label">Konselor</label>
                        <select class="form-select" id="counselor_id_edit{{ $schedule->id }}" name="counselor_id" required>
                            @foreach($counselors as $counselor)
                            <option value="{{ $counselor->id }}" {{ $schedule->counselor_id == $counselor->id ? 'selected' : '' }}>{{ $counselor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="date_edit{{ $schedule->id }}" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="date_edit{{ $schedule->id }}" name="date" value="{{ $schedule->date }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="time_edit{{ $schedule->id }}" class="form-label">Waktu</label>
                            <input type="time" class="form-control" id="time_edit{{ $schedule->id }}" name="time" value="{{ $schedule->time }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="duration_edit{{ $schedule->id }}" class="form-label">Durasi (menit)</label>
                        <select class="form-select" id="duration_edit{{ $schedule->id }}" name="duration">
                            <option value="30" {{ $schedule->duration == '30' ? 'selected' : '' }}>30 menit</option>
                            <option value="60" {{ $schedule->duration == '60' ? 'selected' : '' }}>60 menit</option>
                            <option value="90" {{ $schedule->duration == '90' ? 'selected' : '' }}>90 menit</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="topic_edit{{ $schedule->id }}" class="form-label">Topik</label>
                        <input type="text" class="form-control" id="topic_edit{{ $schedule->id }}" name="topic" value="{{ $schedule->topic }}">
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