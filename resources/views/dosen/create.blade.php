@extends('layouts.app')

@section('title','Tambah Dosen')

@section('content')
    <x-page-header judul="Tambah Dosen" deskripsi="Isi data dosen baru. NIDN dan email harus unik."/>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Form Tambah Dosen</div>
        <div class="card-body">
            <form action="{{ route('dosen.store') }}" method="post" novalidate>
                @csrf
                @include('dosen._form')

                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a class="btn btn-outline-secondary" href="{{ route('dosen.index') }}">Batal</a>
            </form>
        </div>
    </div>
@endsection