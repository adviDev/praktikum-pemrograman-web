<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $statistik = [
            ["judul"=> "mahasiswa", "jumlah" => 1250,
            "icon"=> "bi-mortarboard-fill", "warna" => "primary",],
            ["judul"=> "dosen", "jumlah" => 68,
            "icon"=> "bi-person-badge-fill", "warna" => "success",],
            ["judul"=> "Mata Kuliah", "jumlah" => 94,
            "icon"=> "bi-book-fill", "warna" => "warning",],
            ["judul"=> "KRS Aktif", "jumlah" => 842,
            "icon"=> "bi-journal-check", "warna" => "info",],
            ["judul"=> "Rata-Rata SKS per KRS", "jumlah" => 20,
            "icon"=> "bi-journal-check", "warna" => "info",],
        ];
        $kolomKrs = [
            "nim"    => "NIM",
            "nama"   => "Nama Mahasiswa",
            "sks"    => "SKS",
            "status" => "Status",
        ];

        $krsTerbaru = [
            ["nim"=> "2401001","nama"=> "Ahmad Fauzi",
            "sks" => 22, "status" => "Disetujui"],
            ["nim"=> "2401002","nama"=> "Siti Rahmawati",
            "sks" => 20, "status" => "Disetujui"],
            ["nim"=> "2401003","nama"=> "Budi Santoso",
            "sks" => 24, "status" => "Menunggu"],
            ["nim"=> "2401004","nama"=> "Dewi Lestari",
            "sks" => 18, "status" => "Menunggu"],
            ["nim"=> "2401005","nama"=> "Rizky Pratama",
            "sks" => 21, "status" => "Disetujui"],
        ];

        $statusKrs = [
            ["label"=> "Disetujui", "persen"=> "70", "warna"=> "success"],
            ["label"=> "Menunggu", "persen"=> "22", "warna"=> "Warning"],
            ["label"=> "Ditolak", "persen"=> "8", "warna"=> "danger"],
        ];

        return view("dashboard",compact(
            "statistik","kolomKrs","krsTerbaru","statusKrs"
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
