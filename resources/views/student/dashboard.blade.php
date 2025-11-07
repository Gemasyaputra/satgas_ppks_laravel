@extends('layouts.student')

@section('title', 'Beranda Mahasiswa')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        Selamat Datang, {{ Auth::user()->name }}! Anda login sebagai Mahasiswa.
    </div>
    </div>
@endsection