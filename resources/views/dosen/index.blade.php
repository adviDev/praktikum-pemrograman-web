@extends('layouts.app')

@section('title','Data Dosen')

@section('content')
    <x-page-header judul="Data Dosen" deskripsi="pencarian dan pengurutan diproses di server"/>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Daftar Dosen</span>
            @if (Auth::user()->role==='admin')
                <a class="btn btn-primary btn-sm" href="{{ route('dosen.create') }}">
                    <i class="bi bi-plus-lg"></i> Tambah Dosen
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-dosen" class="table table-striped table-hover align-middle w-100"> 
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap5.min.css') }}">
@endpush

@push('script')
    <script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(function(){
            $('#tabel-dosen').DataTable({
                processing: true,
                serverSide:true,
                ajax: @json(route('dosen.data', [], false)),
                columns:[
                    {data: 'DT_RowIndex', name:'DT_RowIndex',
                        orderable:false,searchable:false},
                    {data: 'nidn',name:'nidn'},
                    {data: 'nama',name:'nama'},
                    {data: 'email',name:'email'},
                    {data: 'telepon',name:'telepon',defaultContent:'-'},
                    {data: 'aksi',name:'aksi',className:'text-nowrap', orderable:false, searchable:false},
                ],
                order:[[2, 'asc']],
                language:{
                    processing: 'memuat data...',
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan_MENU_data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data',
                    infoFiltered: '(disaring dari _MAX data)',
                    zeroRecord: 'Data tidak ditemukan',
                    paginate:{
                        first: 'Awal', last:'Akhir',
                        next: 'Berikutnya', previous:'Sebelumnya',
                    },
                },
            });
        });
    </script>
@endpush