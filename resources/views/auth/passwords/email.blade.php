@extends('layouts.public')

@section('content')
<div class="container py-5 my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-center py-4">
                    <h4 class="fw-bold mb-0 text-white"><i class="bi bi-key-fill me-2"></i>Lupa Password?</h4>
                    <p class="mb-0 small text-white opacity-75">Masukkan email Anda untuk mereset kata sandi.</p>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    
                    @if (session('status'))
                        <div class="alert alert-success border-0 border-start border-4 border-primary shadow-sm rounded-3 mb-4" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold text-secondary">Alamat Email</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-envelope text-primary"></i></span>
                                <input id="email" type="email" class="form-control bg-white border-start-0 ps-0 @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="contoh@politeknik.ac.id">
                            </div>
                            @error('email')
                                <span class="text-danger small fw-bold mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2 shadow-sm text-white fw-bold">
                                <i class="bi bi-send-fill me-2"></i> Kirim Link Reset Password
                            </button>
                            <a href="{{ route('login') }}" class="btn btn-light text-muted py-2">
                                <i class="bi bi-arrow-left me-2"></i> Kembali ke Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection