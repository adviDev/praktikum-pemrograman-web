@extends('layouts.app')

@section('title','Mata Kuliah')

@section('content')
    <x-page-header judul="Data Mata Kuliah" deskripsi="pencarian dan pengurutan diproses di server"/>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Daftar Mata Kuliah</span>
            @if (Auth::user()->role==='admin')
                <a class="btn btn-primary btn-sm" href="{{ route('matakuliah.create') }}">
                    <i class="bi bi-plus-lg"></i> Tambah Mata Kuliah
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-matakuliah" class="table table-striped table-hover align-middle w-100"> 
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuiah</th>
                            <th>SKS</th>
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
            $('#tabel-matakuliah').DataTable({
                processing: true,
                serverSide:true,
                ajax: @json(route('matakuliah.data', [], false)),
                columns:[
                    {data: 'DT_RowIndex', name:'DT_RowIndex',
                        orderable:false,searchable:false},
                    {data: 'kode_mk',name:'kode_mk'},
                    {data: 'nama_mk',name:'nama_mk'},
                    {data: 'sks',name:'sks'},
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

@push('script')
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        const csrfToken = @json(csrf_token());

        $(document).on('click', '.btn-hapus', function(){
            const url = this.dataset.url;
            const nama = this.dataset.nama;

            Swal.fire({
                title: 'Hapus data Mata Kuliah?',
                text: 'Data ' + nama + ' akan dihapus permanen',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#dc3545',
            }).then(function (hasil) {
                if(!hasil.isConfirmed){
                    return;
                }
                $.ajax({
                    url:url,
                    method:'DELETE',
                    headers:{
                        'X-CSRF-TOKEN':csrfToken,
                        'Accept': 'application/json',
                    },
                }).done(function (respons){
                    $('#tabel-matakuliah').DataTable().ajax.reload(null,false);
                    Swal.fire({
                        toast:true, position: 'top-end', icon:'success',
                        title:'Berhasil', text: respons.message,
                        showConfirmButton:false, timer:3000
                    });
                }).fail(function (xhr) {
                    const pesan = (xhr.responseJSON && xhr.responseJSON.message) || 'Data tidak dapat dihapus.';
                    Swal.fire({
                        icon:'error',
                        title:'Gagal ('+ xhr.status +')',
                        text:pesan,
                    });
                });
            });
        });

    </script>
@endpush