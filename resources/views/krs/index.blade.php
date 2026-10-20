@extends('layouts.app')

@section('title','Daftar KRS')

@section('content')
    <x-page-header judul="Daftar KRS" deskripsi="Daftar KRS Mahasiswa(data contoh)"/>
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Daftar KRS Mahasiswa</div>
        <div class="card-body p-0">
            <x-tabel :kolom="$kolom" :baris="$krs"/>
        </div>

    </div>
@endsection