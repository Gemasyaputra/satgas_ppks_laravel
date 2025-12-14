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
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-user-edit me-1"></i> Data Admin
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="small mb-1">Nama Lengkap</label>
                            <input class="form-control" name="name" type="text" value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1">Email Institusi</label>
                            <input class="form-control" name="email" type="email" value="{{ $user->email }}" required>
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-key me-1"></i> Keamanan
                </div>
                <div class="card-body">
                    
                    {{-- CEK APAKAH LOGIN PAKAI GOOGLE? --}}
                    @if($user->google_id)
                        <div class="text-center py-4">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google" width="60" class="mb-3">
                            <h5 class="fw-bold">Akun Terhubung dengan Google</h5>
                            <p class="text-muted small">
                                Anda login menggunakan akun Google ({{ $user->email }}).<br>
                                Silakan kelola password Anda melalui pengaturan Akun Google.
                            </p>
                        </div>
                    @else
                        {{-- JIKA LOGIN MANUAL, TAMPILKAN FORM --}}
                        <form action="{{ route('admin.profile.updatePassword') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label class="small mb-1">Password Saat Ini</label>
                                <input class="form-control @error('current_password') is-invalid @enderror" name="current_password" type="password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">Password Baru</label>
                                    <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Konfirmasi Password</label>
                                    <input class="form-control" name="password_confirmation" type="password" required>
                                </div>
                            </div>

                            <button class="btn btn-danger text-white" type="submit">Ganti Password</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection