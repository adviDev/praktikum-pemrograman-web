@extends('layouts.app')

@section('title','Detail Dosen')

@section('content')

    <x-page-header judul="Detail Dosen" deskripsi="Informasi lengkap satu dosen"/>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            {{ $dosen->nama }}
        </div>
        <div class="card-body">
            <dl class="row mb-3">
                <dt class="col-sm-3">NIDN</dt>
                <dd class="col-sm-9">{{ $dosen->nidn }}</dd>
                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9">{{ $dosen->nama }}</dd>
                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $dosen->email }}</dd>
                <dt class="col-sm-3">Telepon</dt>
                <dd class="col-sm-9">{{ $dosen->telepon ? :'-' }}</dd>
                <dt class="col-sm-3">Alamat</dt>
                <dd class="col-sm-9">{{ $dosen->alamat ?:'-' }}</dd>
            </dl>
            <a class="btn btn-outline-secondary" href="{{ route('dosen.index') }}">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            @if (Auth::user()->role==='admin')
                <a class="btn btn-warning" href="{{ route('dosen.edit',$dosen) }}">
                    <i class="bi bi-pencil-square"></i> Ubah
                </a>
            @endif
        </div>
    </div>
@endsection