@extends('layouts.public')

@section('content')
<div class="container-fluid bg-hero d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">

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
                                <i class="bi bi-box-arrow-in-right text-white fs-1"></i>
                            </div>
                            <h2 class="fw-bold text-dark mb-1">Selamat Datang Kembali</h2>
                            <p class="text-muted">Masuk ke akun Satgas PPKS Anda.</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label fw-medium">{{ __('Email') }}</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-0">
                                        <i class="bi bi-envelope-fill text-muted"></i>
                                    </span>
                                    <input id="email" type="email" class="form-control bg-light border-0 @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                           placeholder="nama@pnp.ac.id">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-medium">{{ __('Password') }}</label>
                                <div class="input-group input-group-lg">
                                     <span class="input-group-text bg-light border-0">
                                        <i class="bi bi-lock-fill text-muted"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control bg-light border-0 @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="current-password"
                                           placeholder="Masukkan password">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label text-muted" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link btn-sm text-warning" href="{{ route('password.request') }}">
                                        {{ __('Lupa password?') }}
                                    </a>
                                @endif
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-warning btn-lg text-white fw-bold shadow-sm">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            <div class="text-center text-muted">
                                Belum punya akun? 
                                <a href="{{ route('register') }}" class="fw-medium text-warning">Daftar sekarang</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection