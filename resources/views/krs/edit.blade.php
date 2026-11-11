@extends('layouts.app')

@section('title','Ubah KRS')

@section('content')
    <x-page-header judul="Ubah KRS" deskripsi="Perbarui data KRS."/>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Form Ubah KRS</div>
        <div class="card-body">
            <form action="{{ route('krs.update',$krs) }}" method="post" novalidate>
                @csrf
                @method('PUT')
                @include('krs._form')

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Perbarui
                </button>
                <a class="btn btn-outline-secondary" href="{{ route('krs.index') }}">Batal</a>
            </form>
        </div>
    </div>
@endsection