<div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1" aria-labelledby="editStudentModalLabel{{ $student->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editStudentModalLabel{{ $student->id }}">Edit Data Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nim{{ $student->id }}" class="form-label">NIM <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nim{{ $student->id }}" name="nim" value="{{ $student->nim }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="name{{ $student->id }}" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name{{ $student->id }}" name="name" value="{{ $student->name }}" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email{{ $student->id }}" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email{{ $student->id }}" name="email" value="{{ $student->email }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone{{ $student->id }}" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="phone{{ $student->id }}" name="phone" value="{{ $student->phone }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="program{{ $student->id }}" class="form-label">Program</label>
                            <select class="form-select" id="program{{ $student->id }}" name="program">
                                <option value="D3" {{ $student->program == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="D4" {{ $student->program == 'D4' ? 'selected' : '' }}>D4</option>
                                <option value="S2" {{ $student->program == 'S2' ? 'selected' : '' }}>S2</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="department{{ $student->id }}" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="department{{ $student->id }}" name="department" value="{{ $student->department }}">
                        </div>
                    </div>

                    <div class="mb-3">
                    <label for="photo{{ $student->id }}" class="form-label">Ganti Foto Mahasiswa</label>
                    <input type="file" class="form-control" id="photo{{ $student->id }}" name="photo" accept="image/png, image/jpeg, image/jpg">
                    <div class="form-text">Kosongkan jika tidak ingin mengubah foto.</div>
                </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_active{{ $student->id }}" name="is_active" value="1" {{ $student->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active{{ $student->id }}">Status Aktif</label>
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