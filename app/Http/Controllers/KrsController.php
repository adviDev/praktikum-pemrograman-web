<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
class KrsController extends Controller
{
    const MAX_SKS = 24;
    public function index():View
    {
        return view("krs.index");
    }

    public function data(): JsonResponse
    {
        $query = Krs::select('krs.*')
            ->with('mahasiswa')
            ->withSum('mataKuliah as total_sks', 'sks');

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('nim', function (Krs $krs) {
                return $krs->mahasiswa?->nim ?? '-';
            })
            ->addColumn('nama', function (Krs $krs) {
                return $krs->mahasiswa?->nama ?? '-';
            })
            ->editColumn('total_sks', function (Krs $krs) {
                return $krs->total_sks ?? 0;
            })
            ->addColumn('aksi', function (Krs $krs) {
                return view('krs._aksi', compact('krs'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        $daftarMahasiswa = Mahasiswa::orderBy('nama', 'asc')->get();
        $daftarMataKuliah = MataKuliah::orderBy('kode_mk', 'asc')->get();
        return view('krs.create', [
            'krs' => new Krs(),
            'daftarMahasiswa' => $daftarMahasiswa,
            'daftarMataKuliah' => $daftarMataKuliah,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $krs = Krs::create($this->validated($request));

        if ($request->has('mata_kuliah_id')) {
            $krs->mataKuliah()->sync($request->input('mata_kuliah_id', []));
        }

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
        $krs->load('mataKuliah');
        $daftarMahasiswa = Mahasiswa::orderBy('nama')->get();
        $daftarMataKuliah = MataKuliah::orderBy('kode_mk', 'asc')->get();
        return view('krs.edit', compact('krs', 'daftarMahasiswa', 'daftarMataKuliah'));
    }

    public function update(Request $request, Krs $krs): RedirectResponse
    {
        $krs->update($this->validated($request, $krs));

        $krs->mataKuliah()->sync($request->input('mata_kuliah_id', []));
        
        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS mahasiswa ' . ($krs->mahasiswa?->nama ?? '') . ' berhasil diperbarui.');
    }

    public function destroy(Krs $krs): JsonResponse
    {
        try {
            $krs->mataKuliah()->detach();
            $nama = $krs->mahasiswa?->nama ?? 'mahasiswa';
            $krs->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Data KRS tidak dapat dihapus: masih dipakai data lain.',
            ], 409);
        }

        return response()->json([
            'message' => 'Data KRS ' . $nama . ' berhasil dihapus.',
        ]);
    }

    public function validated(Request $request, ?Krs $krs = null): array
    {
        $validator = Validator::make($request->all(), [
            'mahasiswa_id'     => ['required', 'exists:mahasiswa,id'],
            'tahun_akademik'   => ['required', 'string', 'max:9'],
            'semester'         => ['required', 'in:Ganjil,Genap'],
            'status'           => ['required', 'in:draft,diajukan,disetujui,ditolak'],
            'mata_kuliah_id'   => ['nullable', 'array'],
            'mata_kuliah_id.*' => ['exists:mata_kuliah,id'],
        ]);
        $validator->after(function ($validator) use ($request) {
            $selectedIds = $request->input('mata_kuliah_id', []);
            if (!empty($selectedIds)) {
                // Hitung total SKS mata kuliah yang dipilih dari database
                $totalSks = MataKuliah::whereIn('id', $selectedIds)->sum('sks');
                // Cek apakah melebihi batas
                if ($totalSks > self::MAX_SKS) {
                    $validator->errors()->add(
                        'mata_kuliah_id', 
                        "Total SKS yang diambil ({$totalSks} SKS) melebihi batas maksimum " . self::MAX_SKS . " SKS per semester."
                    );
                }
            }
        });
        return $validator->validate();
    }
}
