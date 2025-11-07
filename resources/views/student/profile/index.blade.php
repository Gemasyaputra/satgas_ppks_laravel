@extends('layouts.student')

@section('title', 'Profil Saya')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0 mb-4 bg-warning-subtle text-warning-emphasis">
        <div class="card-body p-4 d-flex align-items-center">
            <i class="bi bi-person-circle fs-1 me-3"></i>
            <div>
                <h2 class="h4 fw-medium mb-1">Profil Saya</h2>
                <p class="text-muted mb-0">Kelola informasi pribadi dan keamanan akun Anda.</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Terjadi kesalahan validasi.
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-7">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-medium">Informasi Pribadi & Akademik</h5>
                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#collapseEditProfile" aria-expanded="false" aria-controls="collapseEditProfile">
                        <i class="bi bi-pencil-square me-1"></i> Edit Profil
                    </button>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Nama Lengkap</div>
                        <div class="col-sm-8 fw-medium">{{ $user->name }}</div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">NIM</div>
                        <div class="col-sm-8 fw-medium">{{ $user->nim }}</div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Email</div>
                        <div class="col-sm-8 fw-medium">{{ $user->email }}</div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Nomor Telepon</div>
                        <div class="col-sm-8 fw-medium">{{ $user->phone ?? '-' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Program</div>
                        <div class="col-sm-8 fw-medium">{{ $user->program ?? '-' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Jurusan</div>
                        <div class="col-sm-8 fw-medium">{{ $user->department ?? '-' }}</div>
                    </div>

                    <div class="collapse mt-4" id="collapseEditProfile">
                        <hr>
                        <h5 class="mb-3">Edit Informasi Profil</h5>
                        <form action="{{ route('student.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor Telepon</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Ganti Foto Profil</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/png, image/jpeg, image/jpg">
                                <div class="form-text">Kosongkan jika tidak ingin mengubah foto.</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan Profil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-sm border-0 mb-4 text-center p-4">
                <img src="{{ $user->photo_url ? asset('storage/' . $user->photo_url) : 'https://via.placeholder.com/150' }}" alt="{{ $user->name }}" 
                     class="rounded-circle mx-auto mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                <h4 class="fw-medium mb-0">{{ $user->name }}</h4>
                <p class="text-muted">{{ $user->nim }}</p>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-medium">Keamanan Akun</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('student.profile.updatePassword') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-warning text-white w-100">Ganti Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection