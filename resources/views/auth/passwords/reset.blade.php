@extends('layouts.public')

@section('content')
<div class="container py-5 my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-center py-4">
                    <h4 class="fw-bold mb-0 text-white"><i class="bi bi-shield-lock-fill me-2"></i>Buat Password Baru</h4>
                    <p class="mb-0 small text-white opacity-75">Silakan masukkan kata sandi baru Anda.</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold text-secondary">Alamat Email</label>
                            <input id="email" type="email" class="form-control bg-light text-dark fw-medium" 
                                   name="email" value="{{ $email ?? old('email') }}" required readonly>
                            @error('email')
                                <span class="text-danger small mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold text-secondary">Password Baru</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-lock text-primary"></i></span>
                                <input id="password" type="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter">
                            </div>
                            @error('password')
                                <span class="text-danger small fw-bold mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-bold text-secondary">Ulangi Password Baru</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-check2-circle text-primary"></i></span>
                                <input id="password-confirm" type="password" class="form-control border-start-0 ps-0" 
                                       name="password_confirmation" required autocomplete="new-password" placeholder="Ketik ulang password">
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-2 shadow-sm text-white fw-bold">
                                <i class="bi bi-check-lg me-2"></i> Simpan Password Baru
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection