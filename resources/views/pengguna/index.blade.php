@extends('layouts.app')

@section('title','Data Pengguna')

@section('content')
    <x-page-header judul="Data Pengguna" deskripsi="Akun login SIAKAD (khusus admin)."/>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Daftar Pengguna</div>
        <div class="card-body p-0">
            <x-tabel :baris="$pengguna" :kolom="$kolom"/>
        </div>

    </div>

@endsection