@extends('layouts.app')

@section('title', 'Detail KRS')

@section('content')

    <x-page-header judul="Detail KRS" deskripsi="Informasi lengkap satu KRS"/>

    <div class="card border-0 shadow-sm mb-4">
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
                <dd class="col-sm-9 fw-semibold text-primary">{{ $krs->mataKuliah->sum('sks') }} SKS</dd>
                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    @php
                        $badgeWarna = match($krs->status) {
                            'disetujui' => 'success',
                            'diajukan'  => 'warning',
                            'ditolak'   => 'danger',
                            default     => 'secondary',
                        };
                    @endphp
                    <span class="badge text-bg-{{ $badgeWarna }}">{{ ucfirst($krs->status) }}</span>
                </dd>
            </dl>

            <h6 class="fw-semibold mt-4 mb-2">Daftar Mata Kuliah yang Diambil</h6>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-3">
                    <thead class="table-light">
                        <tr>
                            <th width="50" class="text-center">No</th>
                            <th width="120">Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th width="90" class="text-center">SKS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($krs->mataKuliah as $index => $mk)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $mk->kode_mk }}</td>
                                <td>{{ $mk->nama_mk }}</td>
                                <td class="text-center">{{ $mk->sks }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Belum ada mata kuliah yang diambil pada KRS ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if ($krs->mataKuliah->isNotEmpty())
                        <tfoot>
                            <tr class="fw-bold table-light">
                                <td colspan="3" class="text-end">Total SKS</td>
                                <td class="text-center text-primary">{{ $krs->mataKuliah->sum('sks') }}</td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>

            <div class="d-flex gap-2">
                <a class="btn btn-outline-secondary" href="{{ route('krs.index') }}">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                @if (Auth::user()->role === 'admin')
                    <a class="btn btn-warning" href="{{ route('krs.edit', $krs) }}">
                        <i class="bi bi-pencil-square"></i> Ubah KRS & Mata Kuliah
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
