@extends('layouts.app')

@section('title','Tambah mahasiswa')

@section('content')
    <x-page-header judul="Tambah mahasiswa" deskripsi="Isi data mahasiswa baru. NIM dan email harus unik."/>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Form Tambah Mahasiswa</div>
        <div class="card-body">
            <form action="{{ route('mahasiswa.store') }}" method="post" novalidate>
                @csrf
                @include('mahasiswa._form')

                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a class="btn btn-outline-secondary" href="{{ route('mahasiswa.index') }}">Batal</a>
            </form>
        </div>
    </div>
@endsection