@extends('layouts.app')

@section('title','Ubah mahasiswa')

@section('content')
    <x-page-header judul="Ubah mahasiswa" deskripsi="Perbarui data mahasiswa. NIM dan email harus tetap unik."/>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Form Ubah mahasiswa</div>
        <div class="card-body">
            <form action="{{ route('mahasiswa.update',$mahasiswa) }}" method="post" novalidate>
                @csrf
                @method('PUT')
                @include('mahasiswa._form')

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Perbarui
                </button>
                <a class="btn btn-outline-secondary" href="{{ route('mahasiswa.index') }}">Batal</a>
            </form>
        </div>
    </div>
@endsection