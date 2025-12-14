<div class="modal fade" id="addReportModal" tabindex="-1" aria-labelledby="addReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('student.reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addReportModalLabel">Buat Laporan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-4 bg-light p-3 rounded border">
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input mt-1" type="checkbox" role="switch" id="is_anonymous"
                                name="is_anonymous" value="1">
                            <label class="form-check-label ms-2 fw-bold text-dark mb-0" for="is_anonymous">
                                Laporkan Secara Anonim
                            </label>
                        </div>
                        <p class="small text-muted mt-1 mb-0 ms-4">
                            Identitas Anda (Nama, NIM, dll) tidak akan diketahui oleh Admin/Satgas.
                        </p>
                    </div>

                    <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">I. Identitas Pelapor</h6>
                    
                    <div id="identity-section">
                        <div class="row gx-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Email</label>
                                <input type="email" class="form-control bg-secondary-subtle"
                                    name="reporter_email" value="{{ Auth::user()->email }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Nama Pelapor</label>
                                <input type="text" class="form-control bg-secondary-subtle"
                                    name="reporter_name" value="{{ Auth::user()->name }}" readonly>
                            </div>
                        </div>

                        <div class="row gx-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">NIM / NIP / NIK <span class="text-danger">*</span></label>
                                <input type="text" 
                                    class="form-control {{ Auth::user()->nim ? 'bg-secondary-subtle' : '' }}"
                                    name="reporter_nim" 
                                    value="{{ Auth::user()->nim }}" 
                                    placeholder="Masukkan Nomor Induk"
                                    {{ Auth::user()->nim ? 'readonly' : '' }} required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Prodi / Unit Kerja <span class="text-danger">*</span></label>
                                <input type="text" 
                                    class="form-control {{ Auth::user()->department ? 'bg-secondary-subtle' : '' }}"
                                    name="reporter_prodi" 
                                    value="{{ Auth::user()->department }}" 
                                    placeholder="Masukkan Prodi atau Unit Kerja"
                                    {{ Auth::user()->department ? 'readonly' : '' }} required>
                            </div>
                        </div>

                        <div class="row gx-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="reporter_pob" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="reporter_dob" required>
                            </div>
                        </div>
                        
                        <div class="row gx-3">
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold">Usia <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="reporter_age" required>
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="form-label small fw-bold">Pekerjaan / Jabatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="reporter_occupation"
                                    value="Mahasiswa" placeholder="Contoh: Mahasiswa / Dosen" required>
                            </div>
                        </div>

                        <div class="row gx-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-select" name="reporter_gender" required>
                                    <option value="">Pilih...</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">No. Telepon / WA <span class="text-danger">*</span></label>
                                <input type="text" 
                                    class="form-control {{ Auth::user()->phone ? 'bg-secondary-subtle' : '' }}" 
                                    name="reporter_phone"
                                    value="{{ Auth::user()->phone }}" 
                                    {{ Auth::user()->phone ? 'readonly' : '' }} required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Alamat Domisili <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="reporter_address" rows="2" required></textarea>
                        </div>
                    </div>
                    <h6 class="fw-bold text-primary mb-3 mt-4 border-bottom pb-2">II. Data Kejadian</h6>

                    <div class="row gx-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Jenis Kekerasan <span class="text-danger">*</span></label>
                            <select class="form-select" name="violence_type" required>
                                <option value="">Pilih Kategori...</option>
                                <option value="Kekerasan Psikis">Kekerasan Psikis</option>
                                <option value="Kekerasan Fisik">Kekerasan Fisik</option>
                                <option value="Kekerasan Seksual">Kekerasan Seksual</option>
                                <option value="Perundungan">Perundungan</option>
                                <option value="Diskriminasi & Intoleransi">Diskriminasi & Intoleransi</option>
                                <option value="Kebijakan Kekerasan">Kebijakan dengan unsur kekerasan</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Tanggal Kejadian <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="report_date" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Lokasi Kejadian <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="incident_location"
                            placeholder="Contoh: Gedung C Lt. 2, Area Parkir" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Status Disabilitas Korban <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="disability_status"
                            placeholder="Sebutkan jika ada (Tuna rungu, dll) atau 'Tidak Ada'" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Kronologi Lengkap <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="description" rows="5"
                            placeholder="Ceritakan detail kejadian..." required></textarea>
                    </div>

                    <h6 class="fw-bold text-primary mb-3 mt-4 border-bottom pb-2">III. Data Terlapor (Pelaku)</h6>

                    <div class="row gx-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Nama Terlapor <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="reported_party_name"
                                placeholder="Nama pelaku (jika tahu)" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Perkiraan Usia <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="reported_party_age"
                                placeholder="Contoh: 20" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Status/Pekerjaan Terlapor <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="reported_party_occupation"
                            placeholder="Contoh: Dosen, Mahasiswa Angkatan 2022" required>
                    </div>

                    <h6 class="fw-bold text-primary mb-3 mt-4 border-bottom pb-2">IV. Informasi Tambahan</h6>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Saksi yang Bisa Dihubungi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="witness_contact"
                            placeholder="Nama & No HP Saksi (Isi '-' jika tidak ada)" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Alasan Melapor <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="reason_for_reporting" rows="2" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Kebutuhan Korban Saat Ini <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="victim_needs" rows="2"
                            placeholder="Contoh: Konseling, Pendampingan Hukum" required></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white fw-bold">Kirim Laporan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const anonymousCheck = document.getElementById('is_anonymous');
        const identitySection = document.getElementById('identity-section');

        // Ambil semua input yang WAJIB DIISI di dalam section identitas
        // Kita cari input yang punya attribut 'name' agar spesifik
        const identityInputs = identitySection.querySelectorAll('input, select, textarea');

        function toggleIdentity() {
            if (anonymousCheck.checked) {
                // --- KONDISI ANONIM ---
                // Sembunyikan form identitas
                identitySection.style.display = 'none';
                
                // Matikan 'required' untuk semua field identitas
                identityInputs.forEach(input => {
                    input.required = false; 
                });

            } else {
                // --- KONDISI RESMI (TIDAK ANONIM) ---
                // Munculkan form
                identitySection.style.display = 'block';

                // Nyalakan kembali 'required', TAPI...
                // Hanya untuk field yang TIDAK READONLY. 
                // (Field readonly dianggap sudah terisi data valid dari database)
                identityInputs.forEach(input => {
                    if (!input.hasAttribute('readonly')) {
                        input.required = true;
                    }
                });
            }
        }

        anonymousCheck.addEventListener('change', toggleIdentity);
        toggleIdentity(); // Jalankan saat load awal
    });
</script>