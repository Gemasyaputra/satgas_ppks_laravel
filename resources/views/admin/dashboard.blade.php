@extends('layouts.admin')

@section('title', 'Beranda Admin')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        Selamat Datang, {{ Auth::user()->name }}! Anda login sebagai Admin.
    </div>
    </div>
@endsection