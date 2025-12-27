@extends('layouts.admin')

@section('title', 'Profil Admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Pengaturan Akun</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Profil</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        {{-- KARTU 1: DATA ADMIN --}}
        <div class="col-xl-6">
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-white fw-bold py-3">
                    <i class="bi bi-person-bounding-box me-2 text-primary"></i> Data Admin
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label text-muted small">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                <input class="form-control" name="name" type="text" value="{{ $user->name }}" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small">Email Institusi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                                <input class="form-control" name="email" type="email" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan Profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- KARTU 2: GANTI PASSWORD (DIPERBARUI) --}}
        <div class="col-xl-6">
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-white fw-bold py-3">
                    <i class="bi bi-shield-lock me-2 text-danger"></i> Keamanan & Password
                </div>
                <div class="card-body">
                    
                    {{-- LOGIKA GOOGLE LOGIN --}}
                    @if($user->google_id)
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google" width="70">
                            </div>
                            <h5 class="fw-bold text-dark">Akun Terhubung dengan Google</h5>
                            <p class="text-muted small px-4">
                                Anda login menggunakan akun Google (<strong>{{ $user->email }}</strong>).<br>
                                Password dikelola sepenuhnya oleh Google. Silakan ubah password melalui pengaturan Akun Google Anda.
                            </p>
                            <a href="https://myaccount.google.com/" target="_blank" class="btn btn-outline-secondary btn-sm mt-2">
                                <i class="bi bi-box-arrow-up-right me-1"></i> Buka Akun Google
                            </a>
                        </div>
                    @else
                        {{-- FORM GANTI PASSWORD --}}
                        <form action="{{ route('admin.profile.updatePassword') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            {{-- 1. Password Lama --}}
                            <div class="mb-3">
                                <label class="form-label text-muted small">Password Saat Ini</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-key"></i></span>
                                    <input class="form-control @error('current_password') is-invalid @enderror" 
                                           name="current_password" type="password" id="currentPassword" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('currentPassword', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-4 border-light">

                            {{-- 2. Password Baru --}}
                            <div class="mb-3">
                                <label class="form-label text-muted small">Password Baru</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                                    <input class="form-control @error('password') is-invalid @enderror" 
                                           name="password" type="password" id="newPassword" required 
                                           onkeyup="checkPasswordRules(this.value); checkMatch();">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('newPassword', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                {{-- CHECKLIST PERSYARATAN PASSWORD --}}
                                <div class="mt-2 ps-1">
                                    <small class="text-muted fw-bold d-block mb-1">Syarat Password:</small>
                                    <ul class="list-unstyled small mb-0 text-muted">
                                        <li id="rule-length" class="mb-1">
                                            <i class="bi bi-circle me-1"></i> Minimal 8 karakter
                                        </li>
                                        <li id="rule-upper" class="mb-1">
                                            <i class="bi bi-circle me-1"></i> Huruf Besar (A-Z)
                                        </li>
                                        <li id="rule-lower" class="mb-1">
                                            <i class="bi bi-circle me-1"></i> Huruf Kecil (a-z)
                                        </li>
                                        <li id="rule-number">
                                            <i class="bi bi-circle me-1"></i> Angka (0-9)
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            {{-- 3. Konfirmasi Password --}}
                            <div class="mb-4">
                                <label class="form-label text-muted small">Ulangi Password Baru</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                                    <input class="form-control" name="password_confirmation" type="password" id="confirmPassword" required onkeyup="checkMatch()">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirmPassword', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <div class="mt-1">
                                    <small class="text-danger d-none" id="matchMessage"><i class="bi bi-x-circle-fill me-1"></i> Password tidak sama</small>
                                    <small class="text-success d-none" id="matchMessageSuccess"><i class="bi bi-check-circle-fill me-1"></i> Password cocok</small>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-danger" type="submit" id="submitBtn">
                                    <i class="bi bi-shield-check me-1"></i> Ganti Password
                                </button>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT VALIDASI REAL-TIME --}}
<script>
    // 1. Fitur Show/Hide Password
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }

    // 2. Cek Aturan Password (Checklist)
    function checkPasswordRules(password) {
        // Definisi elemen
        const rules = {
            length: { el: document.getElementById('rule-length'), valid: password.length >= 8 },
            upper:  { el: document.getElementById('rule-upper'), valid: /[A-Z]/.test(password) },
            lower:  { el: document.getElementById('rule-lower'), valid: /[a-z]/.test(password) },
            number: { el: document.getElementById('rule-number'), valid: /[0-9]/.test(password) }
        };

        // Loop untuk update UI setiap aturan
        for (const key in rules) {
            const rule = rules[key];
            const icon = rule.el.querySelector('i');

            if (rule.valid) {
                rule.el.classList.remove('text-muted', 'text-danger');
                rule.el.classList.add('text-success');
                icon.className = 'bi bi-check-circle-fill me-1';
            } else {
                rule.el.classList.remove('text-success');
                rule.el.classList.add('text-muted');
                // Jika user sudah mengetik tapi salah, bisa dikasih warna merah (opsional)
                if(password.length > 0) {
                     // rule.el.classList.add('text-danger'); // Uncomment jika ingin merah saat belum valid
                }
                icon.className = 'bi bi-circle me-1';
            }
        }
    }

    // 3. Cek Kesamaan Password
    function checkMatch() {
        const pass = document.getElementById('newPassword').value;
        const confirm = document.getElementById('confirmPassword').value;
        const msgError = document.getElementById('matchMessage');
        const msgSuccess = document.getElementById('matchMessageSuccess');

        if (confirm.length > 0) {
            if (pass !== confirm) {
                msgError.classList.remove('d-none');
                msgSuccess.classList.add('d-none');
            } else {
                msgError.classList.add('d-none');
                msgSuccess.classList.remove('d-none');
            }
        } else {
            msgError.classList.add('d-none');
            msgSuccess.classList.add('d-none');
        }
    }
</script>
@endsection