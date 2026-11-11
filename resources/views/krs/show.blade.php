@extends('layouts.app')

@section('title', 'Detail KRS')

@section('content')

    <x-page-header judul="Detail KRS" deskripsi="Informasi lengkap satu KRS"/>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            {{ $krs->mahasiswa?->nama ?? 'Detail KRS' }}
        </div>
        <div class="card-body">
            <dl class="row mb-3">
                <dt class="col-sm-3">NIM Mahasiswa</dt>
                <dd class="col-sm-9">{{ $krs->mahasiswa?->nim ?? '-' }}</dd>
                <dt class="col-sm-3">Nama Mahasiswa</dt>
                <dd class="col-sm-9">{{ $krs->mahasiswa?->nama ?? '-' }}</dd>
                <dt class="col-sm-3">Program Studi</dt>
                <dd class="col-sm-9">{{ $krs->mahasiswa?->program_studi ?? '-' }}</dd>
                <dt class="col-sm-3">Angkatan</dt>
                <dd class="col-sm-9">{{ $krs->mahasiswa?->angkatan ?? '-' }}</dd>
                <dt class="col-sm-3">Tahun Akademik</dt>
                <dd class="col-sm-9">{{ $krs->tahun_akademik }}</dd>
                <dt class="col-sm-3">Semester</dt>
                <dd class="col-sm-9">{{ $krs->semester }}</dd>
                <dt class="col-sm-3">Total SKS</dt>
                <dd class="col-sm-9">{{ $krs->total_sks }}</dd>
                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">{{ ucfirst($krs->status) }}</dd>
            </dl>
            <a class="btn btn-outline-secondary" href="{{ route('krs.index') }}">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            @if (Auth::user()->role==='admin')
                <a class="btn btn-warning" href="{{ route('krs.edit',$krs) }}">
                    <i class="bi bi-pencil-square"></i> Ubah
                </a>
            @endif
        </div>
    </div>
@endsection
