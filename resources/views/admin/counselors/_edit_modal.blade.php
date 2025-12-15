<div class="modal fade" id="editCounselorModal{{ $counselor->id }}" tabindex="-1" aria-labelledby="editCounselorModalLabel{{ $counselor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.counselors.update', $counselor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editCounselorModalLabel{{ $counselor->id }}">Edit Anggota Satgas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="role{{ $counselor->id }}" class="form-label">Peran <span class="text-danger">*</span></label>
                        <select class="form-select" id="role{{ $counselor->id }}" name="role" required>
                            <option value="Mahasiswa Satgas" {{ $counselor->role == 'Mahasiswa Satgas' ? 'selected' : '' }}>Mahasiswa Satgas</option>
                            <option value="Tenaga Pendidik" {{ $counselor->role == 'Tenaga Pendidik' ? 'selected' : '' }}>Tenaga Pendidik</option>
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name{{ $counselor->id }}" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name{{ $counselor->id }}" name="name" value="{{ $counselor->name }}" required>
                        </div>
                        {{-- <div class="col-md-6">
                            <label for="specialization{{ $counselor->id }}" class="form-label">Spesialisasi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="specialization{{ $counselor->id }}" name="specialization" value="{{ $counselor->specialization }}" required>
                        </div> --}}
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email{{ $counselor->id }}" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email{{ $counselor->id }}" name="email" value="{{ $counselor->email }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone{{ $counselor->id }}" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone{{ $counselor->id }}" name="phone" value="{{ $counselor->phone }}" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                        <label for="photo{{ $counselor->id }}" class="form-label">Foto Konselor (Baru)</label>
                        <input type="file" class="form-control" id="photo{{ $counselor->id }}" name="photo" accept="image/png, image/jpeg, image/jpg">
                        <div class="form-text">Kosongkan jika tidak ingin mengubah foto.</div>
                    </div>
                        <div class="col-md-6">
                            <label for="experience{{ $counselor->id }}" class="form-label">Pengalaman</label>
                            <input type="text" class="form-control" id="experience{{ $counselor->id }}" name="experience" value="{{ $counselor->experience }}">
                        </div>
                    </div>

                    {{-- <div class="mb-3">
                        <label for="description{{ $counselor->id }}" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description{{ $counselor->id }}" name="description" rows="3">{{ $counselor->description }}</textarea>
                    </div> --}}

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_active{{ $counselor->id }}" name="is_active" value="1" {{ $counselor->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active{{ $counselor->id }}">Status Aktif</label>
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