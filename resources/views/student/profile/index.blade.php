@extends('layouts.student')

@section('title', 'Profil Saya')

@section('content')
<div class="container-fluid">
    
    <div class="card shadow-sm border-0 mb-4 bg-warning-subtle text-warning-emphasis">
        <div class="card-body p-4 d-flex align-items-center">
            <div class="bg-white bg-opacity-50 rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                <i class="bi bi-person-circle fs-2"></i>
            </div>
            <div>
                <h2 class="h4 fw-bold mb-1">Profil Saya</h2>
                <p class="text-dark opacity-75 mb-0">Kelola informasi pribadi dan keamanan akun Anda.</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
             <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <strong>Error!</strong> Terjadi kesalahan validasi.
            <ul class="mb-0 small mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Informasi Pribadi</h5>
                    <button class="btn btn-sm btn-outline-warning fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEditProfile" aria-expanded="false" aria-controls="collapseEditProfile">
                        <i class="bi bi-pencil-square me-1"></i> Edit Profil
                    </button>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-3 align-items-center">
                        <div class="col-sm-4 text-muted small text-uppercase fw-bold">Nama Lengkap</div>
                        <div class="col-sm-8 fw-medium text-dark">{{ $user->name }}</div>
                    </div>
                    <hr class="text-secondary opacity-10">
                    <div class="row mb-3 align-items-center">
                        <div class="col-sm-4 text-muted small text-uppercase fw-bold">NIM</div>
                        <div class="col-sm-8 fw-medium text-dark">{{ $user->nim }}</div>
                    </div>
                    <hr class="text-secondary opacity-10">
                    <div class="row mb-3 align-items-center">
                        <div class="col-sm-4 text-muted small text-uppercase fw-bold">Email</div>
                        <div class="col-sm-8 fw-medium text-dark">{{ $user->email }}</div>
                    </div>
                    <hr class="text-secondary opacity-10">
                    <div class="row mb-3 align-items-center">
                        <div class="col-sm-4 text-muted small text-uppercase fw-bold">No. Telepon</div>
                        <div class="col-sm-8 fw-medium text-dark">{{ $user->phone ?? '-' }}</div>
                    </div>
                    <hr class="text-secondary opacity-10">
                    <div class="row mb-3 align-items-center">
                        <div class="col-sm-4 text-muted small text-uppercase fw-bold">Jurusan / Prodi</div>
                        <div class="col-sm-8 fw-medium text-dark">
                            {{ $user->department ?? '-' }} <span class="text-muted mx-1">/</span> {{ $user->program ?? '-' }}
                        </div>
                    </div>

                    <div class="collapse mt-4" id="collapseEditProfile">
                        <div class="card card-body bg-light border-0">
                            <h6 class="fw-bold text-warning mb-3">Edit Data</h6>
                            <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label small fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label small fw-bold">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label small fw-bold">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="photo" class="form-label small fw-bold">Ganti Foto Profil</label>
                                    <input type="file" class="form-control" id="photo" name="photo" accept="image/png, image/jpeg, image/jpg">
                                    <div class="form-text">Format: JPG, PNG. Maks 2MB.</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="department" class="form-label small fw-bold">Jurusan</label>
                                        <input type="text" class="form-control" id="department" name="department" value="{{ old('department', $user->department) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="program" class="form-label small fw-bold">Program Studi</label>
                                        <input type="text" class="form-control" id="program" name="program" value="{{ old('program', $user->program) }}">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end gap-2 mt-2">
                                    <button type="button" class="btn btn-light text-muted" data-bs-toggle="collapse" data-bs-target="#collapseEditProfile">Batal</button>
                                    <button type="submit" class="btn btn-warning text-white fw-bold shadow-sm">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-sm border-0 mb-4 text-center p-4">
                <div class="position-relative d-inline-block mx-auto mb-3">
                    <img src="{{ $user->photo_url ? asset('storage/' . $user->photo_url) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&size=150' }}" 
                         alt="{{ $user->name }}" 
                         class="rounded-circle shadow-sm border border-4 border-white" 
                         style="width: 150px; height: 150px; object-fit: cover;">
                    <span class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-2" title="Status Aktif"></span>
                </div>
                <h4 class="fw-bold mb-0 text-dark">{{ $user->name }}</h4>
                <p class="text-muted mb-0">{{ $user->nim }}</p>
                <span class="badge bg-warning-subtle text-warning-emphasis mt-2 rounded-pill px-3"></span>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="mb-0 fw-bold text-danger"><i class="bi bi-shield-lock me-2"></i>Keamanan Akun</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('student.profile.updatePassword') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="current_password" class="form-label small fw-bold">Password Saat Ini <span class="text-danger">*</span></label>
                            <input type="password" class="form-control bg-light border-0" id="current_password" name="current_password" required>
                        </div>  
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-bold">Password Baru <span class="text-danger">*</span></label>
                            <input type="password" class="form-control bg-light border-0" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label small fw-bold">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                            <input type="password" class="form-control bg-light border-0" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-warning text-white w-100 fw-bold shadow-sm">
                            <i class="bi bi-key-fill me-1"></i> Ganti Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection