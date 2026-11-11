@extends('layouts.app')

@section('title','Tambah Mata Kuliah')

@section('content')
    <x-page-header judul="Tambah Mata Kuliah" deskripsi="Isi data mata kuliah baru. kode mata kuliah harus unik."/>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Form Tambah Mata Kuliah</div>
        <div class="card-body">
            <form action="{{ route('matakuliah.store') }}" method="post" novalidate>
                @csrf
                @include('matakuliah._form')

                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a class="btn btn-outline-secondary" href="{{ route('matakuliah.index') }}">Batal</a>
            </form>
        </div>
    </div>
@endsection