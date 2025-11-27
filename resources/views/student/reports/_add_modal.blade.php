<div class="modal fade" id="addReportModal" tabindex="-1" aria-labelledby="addReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('student.reports.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addReportModalLabel">Buat Laporan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input mt-1" type="checkbox" role="switch" id="is_anonymous"
                                name="is_anonymous" value="1">
                            <label class="form-check-label ms-2 fw-medium text-dark mb-0" for="is_anonymous">
                                Laporkan Secara Anonim
                            </label>
                        </div>
                        <p class="small text-muted mt-1">
                            Jika dicentang, identitas Anda akan disembunyikan dari admin.
                        </p>
                    </div>

                    <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">I. Identitas Pelapor</h6>
                    <div id="identity-section">
                        <div class="row gx-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Email</label>
                                <input type="email" class="form-control bg-secondary-subtle border-0"
                                    name="reporter_email" value="{{ Auth::user()->email }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Nama Pelapor</label>
                                <input type="text" class="form-control bg-secondary-subtle border-0"
                                    name="reporter_name" value="{{ Auth::user()->name }}" readonly>
                            </div>
                        </div>
                        <div class="row gx-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">NIM</label>
                                <input type="text" class="form-control bg-secondary-subtle border-0"
                                    name="reporter_nim" value="{{ Auth::user()->nim ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Prodi</label>
                                <input type="text" class="form-control bg-secondary-subtle border-0"
                                    name="reporter_prodi" value="{{ Auth::user()->department ?? '-' }}" readonly>
                            </div>
                        </div>

                        <div class="row gx-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Tempat Lahir <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control bg-light border-0" name="reporter_pob"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Tanggal Lahir <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control bg-light border-0" name="reporter_dob"
                                    required>
                            </div>
                        </div>
                        <div class="row gx-3">
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold">Usia <span class="text-danger">*</span></label>
                                <input type="number" class="form-control bg-light border-0" name="reporter_age"
                                    required>
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="form-label small fw-bold">Pekerjaan <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control bg-light border-0" name="reporter_occupation"
                                    value="Mahasiswa" required>
                            </div>
                        </div>
                        <div class="row gx-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Jenis Kelamin <span
                                        class="text-danger">*</span></label>
                                <select class="form-select bg-light border-0" name="reporter_gender" required>
                                    <option value="">Pilih...</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">No. Telepon <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control bg-light border-0" name="reporter_phone"
                                    value="{{ Auth::user()->phone }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Alamat Domisili <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control bg-light border-0" name="reporter_address" rows="2" required></textarea>
                        </div>
                    </div>

                    <h6 class="fw-bold text-primary mb-3 mt-4 border-bottom pb-2">II. Data Kejadian</h6>

                    <div class="row gx-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Jenis Kekerasan <span
                                    class="text-danger">*</span></label>
                            <select class="form-select bg-light border-0" name="violence_type" required>
                                <option value="">Pilih Kategori...</option>
                                <option value="Kekerasan Verbal">Kekerasan Verbal</option>
                                <option value="Kekerasan Fisik">Kekerasan Fisik</option>
                                <option value="Pelecehan Seksual">Pelecehan Seksual</option>
                                <option value="Kekerasan Berbasis Gender Online">KBGO</option>
                                <option value="Diskriminasi">Diskriminasi</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Tanggal Kejadian <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control bg-light border-0" name="report_date" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Lokasi Kejadian <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control bg-light border-0" name="incident_location"
                            placeholder="Contoh: Gedung C Lt. 2, Area Parkir, dll" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Status Disabilitas Korban <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control bg-light border-0" name="disability_status"
                            placeholder="Sebutkan jika ada (Tuna rungu, Tuna daksa, dll) atau 'Tidak Ada'" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Kronologi Lengkap (Deskripsi) <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control bg-light border-0" name="description" rows="5"
                            placeholder="Jelaskan kronologi kejadian selengkap-lengkapnya..." required></textarea>
                    </div>

                    <h6 class="fw-bold text-primary mb-3 mt-4 border-bottom pb-2">III. Data Terlapor (Pelaku)</h6>

                    <div class="row gx-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Nama Terlapor <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light border-0" name="reported_party_name"
                                placeholder="Nama pelaku (jika tahu)" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Perkiraan Usia <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control bg-light border-0" name="reported_party_age"
                                placeholder="Contoh: 20" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Status/Pekerjaan Terlapor <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control bg-light border-0" name="reported_party_occupation"
                            placeholder="Contoh: Dosen, Mahasiswa Angkatan 2022, Staff Admin" required>
                    </div>

                    <h6 class="fw-bold text-primary mb-3 mt-4 border-bottom pb-2">IV. Informasi Tambahan</h6>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Saksi yang Bisa Dihubungi <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control bg-light border-0" name="witness_contact"
                            placeholder="Nama & No HP Saksi (Isi '-' jika tidak ada)" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Alasan Melapor <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control bg-light border-0" name="reason_for_reporting" rows="2" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Kebutuhan Korban Saat Ini <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control bg-light border-0" name="victim_needs" rows="2"
                            placeholder="Contoh: Konseling psikologis, Pendampingan hukum, Medis" required></textarea>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const anonymousCheck = document.getElementById('is_anonymous');
        const identitySection = document.getElementById('identity-section');

        // Ambil semua input/select/textarea di dalam identity-section yang punya atribut required
        const identityInputs = identitySection.querySelectorAll('[required]');

        function toggleIdentity() {
            if (anonymousCheck.checked) {
                // 1. Sembunyikan Bagian Identitas
                identitySection.style.display = 'none';

                // 2. Hilangkan kewajiban mengisi (required) agar form bisa dikirim
                identityInputs.forEach(function(input) {
                    input.removeAttribute('required');
                });
            } else {
                // 1. Tampilkan Kembali
                identitySection.style.display = 'block';

                // 2. Wajibkan mengisi kembali
                identityInputs.forEach(function(input) {
                    input.setAttribute('required', 'required');
                });
            }
        }

        // Jalankan fungsi saat checkbox diklik
        anonymousCheck.addEventListener('change', toggleIdentity);

        // Jalankan sekali saat halaman dimuat (untuk handle jika user refresh halaman)
        toggleIdentity();
    });
</script>
