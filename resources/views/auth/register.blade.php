@extends('layouts.public')

@section('content')
<div class="container-fluid bg-hero d-flex align-items-center justify-content-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10">

                <div class="text-center mb-3">
                    <a href="/" class="btn btn-link text-warning fw-medium">
                        <i class="bi bi-arrow-left me-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>

                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <div class="card-body p-lg-4">
                        <div class="text-center mb-4">
                            <div class="d-inline-flex bg-warning bg-gradient rounded-3 p-3 mb-3 shadow-sm">
                                <i class="bi bi-person-plus-fill text-white fs-1"></i>
                            </div>
                            <h2 class="fw-bold text-dark mb-1">Registrasi Mahasiswa</h2>
                            <p class="text-muted">Daftar untuk mengakses layanan PPKS.</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-medium">{{ __('Nama Lengkap') }}</label>
                                        <input id="name" type="text" class="form-control bg-light border-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama lengkap Anda">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="nim" class="form-label fw-medium">{{ __('NIM') }}</label>
                                        <input id="nim" type="text" class="form-control bg-light border-0 @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" required placeholder="Contoh: 2101011001">
                                        @error('nim')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-medium">{{ __('Email') }}</label>
                                        <input id="email" type="email" class="form-control bg-light border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nama@pnp.ac.id">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="phone" class="form-label fw-medium">{{ __('Nomor Telepon') }}</label>
                                        <input id="phone" type="tel" class="form-control bg-light border-0 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required placeholder="08xxxxxxxxxx">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="program" class="form-label fw-medium">{{ __('Program') }}</label>
                                        <select id="program" name="program" class="form-select bg-light border-0 @error('program') is-invalid @enderror">
                                            <option value="D3">D3</option>
                                            <option value="D4">D4</option>
                                            <option value="S2">S2</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="department" class="form-label fw-medium">{{ __('Jurusan') }}</label>
                                        <input id="department" type="text" class="form-control bg-light border-0 @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}" required placeholder="Contoh: Teknik Informatika">
                                        @error('department')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label fw-medium">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control bg-light border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password-confirm" class="form-label fw-medium">{{ __('Konfirmasi Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control bg-light border-0" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password">
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid my-3">
                                <button type="submit" class="btn btn-warning btn-lg text-white fw-bold shadow-sm">
                                    {{ __('Daftar') }}
                                </button>
                            </div>

                            <div class="text-center text-muted">
                                Sudah punya akun? 
                                <a href="{{ route('login') }}" class="fw-medium text-warning">Login sekarang</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection