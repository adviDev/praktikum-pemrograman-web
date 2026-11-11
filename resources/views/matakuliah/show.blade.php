@extends('layouts.app')

@section('title', 'Detail Mata Kulliah')

@section('content')

    <x-page-header judul="Detail Mata Kulliah" deskripsi="Informasi lengkap satu Mata Kulliah"/>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            {{ $matakuliah->nama_mk }}
        </div>
        <div class="card-body">
            <dl class="row mb-3">
                <dt class="col-sm-3">Kode Mata Kuliah</dt>
                <dd class="col-sm-9">{{ $matakuliah->kode_mk }}</dd>
                <dt class="col-sm-3">Nama Mata Kuliah</dt>
                <dd class="col-sm-9">{{ $matakuliah->nama_mk }}</dd>
                <dt class="col-sm-3">SKS</dt>
                <dd class="col-sm-9">{{ $matakuliah->sks }}</dd>
            </dl>
            <a class="btn btn-outline-secondary" href="{{ route('matakuliah.index') }}">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            @if (Auth::user()->role==='admin')
                <a class="btn btn-warning" href="{{ route('matakuliah.edit',$matakuliah) }}">
                    <i class="bi bi-pencil-square"></i> Ubah
                </a>
            @endif
        </div>
    </div>
@endsection
