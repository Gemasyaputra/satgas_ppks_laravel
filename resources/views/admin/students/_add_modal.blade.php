<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Tambah Mahasiswa Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nim" name="nim"
                                placeholder="2101011001" required>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Lengkap <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nama Mahasiswa" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="mahasiswa@pnp.ac.id" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                placeholder="0811-xxxx-xxxx">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="program" class="form-label">Program</label>
                            <select class="form-select" id="program" name="program">
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                                <option value="S2">S2</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="department" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="department" name="department"
                                placeholder="Contoh: Teknik Informatika">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto Mahasiswa</label>
                        <input type="file" class="form-control" id="photo" name="photo"
                            accept="image/png, image/jpeg, image/jpg">
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active"
                            value="1" checked>
                        <label class="form-check-label" for="is_active">Status Aktif</label>
                    </div>

                    <div class="alert alert-info small mt-3">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        Password awal mahasiswa akan diatur sama dengan <strong>NIM</strong> mereka.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white">Tambah Mahasiswa</button>
                </div>
            </form>
        </div>
    </div>
</div>
