<div class="modal fade" id="addCounselorModal" tabindex="-1" aria-labelledby="addCounselorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.counselors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addCounselorModalLabel">Tambah Anggota Satgas Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="role" class="form-label">Peran <span class="text-danger">*</span></label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="Mahasiswa Satgas">Mahasiswa Satgas</option>
                            <option value="Tenaga Pendidik">Tenaga Pendidik</option>
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Lengkap <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Dr. Nama Lengkap, M.Psi" required>
                        </div>
                        <div class="col-md-6">
                            <label for="specialization" class="form-label">Spesialisasi <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="specialization" name="specialization"
                                placeholder="Contoh: Psikolog Klinis" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="konselor@pnp.ac.id" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Nomor Telepon <span
                                    class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                placeholder="0811-xxxx-xxxx" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="photo" class="form-label">Foto Konselor</label>
                            <input type="file" class="form-control" id="photo" name="photo"
                                accept="image/png, image/jpeg, image/jpg">
                        </div>
                        <div class="col-md-6">
                            <label for="experience" class="form-label">Pengalaman</label>
                            <input type="text" class="form-control" id="experience" name="experience"
                                placeholder="Contoh: 10 tahun">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Jelaskan keahlian..."></textarea>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active"
                            value="1" checked>
                        <label class="form-check-label" for="is_active">Status Aktif</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white">Tambah Konselor</button>
                </div>
            </form>
        </div>
    </div>
</div>
