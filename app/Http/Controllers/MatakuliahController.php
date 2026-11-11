<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class MatakuliahController extends Controller
{
    public function index(): View
    {
       return view("matakuliah.index");
    }

    public function data(): JsonResponse
    {
        $query = MataKuliah::query()->select(['id','kode_mk','nama_mk','sks']);
        
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function (MataKuliah $matakuliah) {
                return view('matakuliah._aksi', compact('matakuliah'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        return view('matakuliah.create', ['matakuliah' => new MataKuliah()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $matakuliah = MataKuliah::create($this->validated($request));

        return redirect()
            ->route('matakuliah.index')
            ->with('success','Data Mata Kuiah  ' . $matakuliah->nama_mk . ' berhasil ditambahkan');
    }

    public function show(MataKuliah $matakuliah): View
    {
        return view('matakuliah.show', compact('matakuliah'));
    }

    public function edit(MataKuliah $matakuliah): View
    {
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, MataKuliah $matakuliah): RedirectResponse
    {
        $matakuliah->update($this->validated($request, $matakuliah));
        
        return redirect()
            ->route('matakuliah.index')
            ->with('success','Data Mata Kuliah ' . $matakuliah->nama_mk . ' berhasil diperbarui.');
    }

    public function destroy(MataKuliah $matakuliah): JsonResponse
    {
        try {
            $matakuliah->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Data mata kuliah tidak dapat dihapus: masih dipakai data lain',
            ],409);
        }
        return response()->json([
            'message'=> 'Data mata kuliah' . $matakuliah->nama . ' berhasil dihapus.',
        ]);
    }

    public function validated(Request $request, ?MataKuliah $matakuliah = null): array
    {
        return $request->validate([
            'kode_mk'=> ['required','string','max:15',
                Rule::unique(MataKuliah::class, 'kode_mk')->ignore($matakuliah?->id)],
            'nama_mk'=> ['required','string','max:50',],
            'sks'=> ['required','string','max:2',],
        ],[
            'kode_mk.required' => 'Kode Mata Kuliah wajib diisi.',
            'kode_mk.max' => 'Kode Mata Kuliah maksimal 15 karakter.',
            'kode_mk.unique' => 'Kode Mata Kuliah sudah dipakai mata kuliah lain.',
            'nama_mk.required' => 'Nama mata kuliah wajib diisi.',
            'nama_mk.max' => 'Nama maksimal 50 karakter.',
            'sks.required' => 'SKS wajib diisi.',
            'sks.max' => 'SKS maksimal 2 karakter.',
        ]);
    }
}
