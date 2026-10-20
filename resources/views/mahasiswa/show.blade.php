@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
    <x-page-header judul="Detail Mahasiswa" deskripsi="Informasi lengkap data mahasiswa.">
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </x-page-header>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-body fw-semibold">
                    Profil Mahasiswa
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4 text-body-secondary">NIM</dt>
                        <dd class="col-sm-8 fw-semibold">{{ $detail['nim'] }}</dd>

                        <dt class="col-sm-4 text-body-secondary">Nama Lengkap</dt>
                        <dd class="col-sm-8">{{ $detail['nama'] }}</dd>

                        <dt class="col-sm-4 text-body-secondary">Angkatan</dt>
                        <dd class="col-sm-8">{{ $detail['angkatan'] }}</dd>

                        <dt class="col-sm-4 text-body-secondary">Email</dt>
                        <dd class="col-sm-8">{{ $detail['email'] }}</dd>

                        <dt class="col-sm-4 text-body-secondary">Status</dt>
                        <dd class="col-sm-8">
                            @php
                                $warna = match($detail['status']) {
                                    'Aktif','Disetujui'  => 'success',
                                    'Menunggu','Cuti'    => 'warning',
                                    'Ditolak','Drop Out' => 'danger',
                                    'Lulus'              => 'primary',
                                    default              => 'secondary',
                                };
                            @endphp
                            <span class="badge text-bg-{{ $warna }}">{{ $detail['status'] }}</span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection
