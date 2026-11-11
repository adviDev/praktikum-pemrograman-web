@extends('layouts.app')

@section('title','Tambah KRS')

@section('content')
    <x-page-header judul="Tambah KRS" deskripsi="Isi data KRS baru."/>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Form Tambah KRS</div>
        <div class="card-body">
            <form action="{{ route('krs.store') }}" method="post" novalidate>
                @csrf
                @include('krs._form')

                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a class="btn btn-outline-secondary" href="{{ route('krs.index') }}">Batal</a>
            </form>
        </div>
    </div>
@endsection