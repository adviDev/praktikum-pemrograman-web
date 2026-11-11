<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class KrsController extends Controller
{
    public function index():View
    {
        return view("krs.index");
    }

    public function data(): JsonResponse
{
    // Ambil data KRS sekaligus gandeng data relasi mahasiswanya
    $query = Krs::with('mahasiswa')->select('krs.*');

    return DataTables::eloquent($query)
        ->addIndexColumn()
        // Ambil NIM dari relasi mahasiswa
        ->addColumn('nim', function (Krs $krs) {
            return $krs->mahasiswa?->nim ?? '-';
        })
        // Ambil Nama dari relasi mahasiswa
        ->addColumn('nama', function (Krs $krs) {
            return $krs->mahasiswa?->nama ?? '-';
        })
        // Hitung total SKS dari mata kuliah yang diambil
        ->addColumn('total_sks', function (Krs $krs) {
            return $krs->mataKuliah()->sum('sks') ?? 0;
        })
        // Tombol aksi (Detail, Ubah, Hapus)
        ->addColumn('aksi', function (Krs $krs) {
            return view('krs._aksi', compact('krs'))->render();
        })
        ->rawColumns(['aksi'])
        ->toJson();
}

    public function create(): View
    {
        $daftarMahasiswa = Mahasiswa::orderBy('nama', 'asc')->get();
        return view('krs.create', ['krs' => new Krs(), 'daftarMahasiswa' => $daftarMahasiswa]);
    }

    public function store(Request $request): RedirectResponse
    {
        $krs = Krs::create($this->validated($request));

        return redirect()->route('krs.index')
            ->with('success', 'Data KRS mahasiswa ' . ($krs->mahasiswa?->nama ?? '') . ' berhasil ditambahkan.');
    }

    public function show(Krs $krs): View
    {
        // Muat data relasi mahasiswa dan daftar mata kuliahnya
        $krs->load(['mahasiswa', 'mataKuliah']);

        return view('krs.show', compact('krs'));
    }

    public function edit(Krs $krs): View
    {
        $daftarMahasiswa = Mahasiswa::orderBy('nama')->get();
        return view('krs.edit', compact('krs','daftarMahasiswa'));
    }

    public function update(Request $request, Krs $krs): RedirectResponse
    {
        $krs->update($this->validated($request, $krs));
        
        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS mahasiswa ' . ($krs->mahasiswa?->nama ?? '') . ' berhasil diperbarui.');
    }

    public function validated(Request $request, ?Krs $krs = null): array
    {
        return $request->validate([
            'mahasiswa_id'   => ['required', 'exists:mahasiswa,id'],
            'tahun_akademik' => [
                'required',
                'string',
                'max:9',
                Rule::unique('krs')
                    ->where(fn ($query) => $query
                        ->where('mahasiswa_id', $request->mahasiswa_id)
                        ->where('tahun_akademik', $request->tahun_akademik)
                        ->where('semester', $request->semester)
                    )
                    ->ignore($krs?->id),
            ],
            'semester'       => ['required', 'in:Ganjil,Genap'],
            'status'         => ['required', 'in:draft,diajukan,disetujui,ditolak'],
        ], [
            'mahasiswa_id.required'   => 'Mahasiswa wajib dipilih.',
            'mahasiswa_id.exists'     => 'Mahasiswa tidak valid.',
            'tahun_akademik.required' => 'Tahun akademik wajib diisi.',
            'tahun_akademik.unique'   => 'Mahasiswa ini sudah memiliki KRS pada tahun akademik dan semester tersebut.',
            'semester.required'       => 'Semester wajib dipilih.',
            'status.required'         => 'Status wajib dipilih.',
        ]);
    }
}
