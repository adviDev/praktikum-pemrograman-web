@extends('layouts.app')

@section('title','Ubah mata kuliah')

@section('content')
    <x-page-header judul="Ubah mata kuliah" deskripsi="Perbarui data mata kuliah. Kode mata kuliah harus tetap unik."/>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Form Ubah Mata Kuliah</div>
        <div class="card-body">
            <form action="{{ route('matakuliah.update',$matakuliah) }}" method="post" novalidate>
                @csrf
                @method('PUT')
                @include('matakuliah._form')

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Perbarui
                </button>
                <a class="btn btn-outline-secondary" href="{{ route('matakuliah.index') }}">Batal</a>
            </form>
        </div>
    </div>
@endsection