<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function index():View
    {
        $kolom = [
            "nim"=> "NIM", "nama"=> "Nama Lengkap",
            "angkatan"=> "Angkatan", "email"=> "Email",
            "status"=> "Status",
        ];

        $mahasiswa = [
            ["nim"=> "2401001",
            "nama"=> "Ahmad Fauzi",
            "angkatan"=> 2024,
            "email"=> "ahmat.fauzi@contoh.ac.id",
            "status"=> "Aktif",],
            ["nim"=> "2401002",
            "nama"=> "Siti Rahmawati",
            "angkatan"=> 2024,
            "email"=> "siti.rahmawati@contoh.ac.id",
            "status"=> "Aktif",],
            ["nim"=> "2401005",
            "nama"=> "Budi Santoso",
            "angkatan"=> 2023,
            "email"=> "budi.santoso@contoh.ac.id",
            "status"=> "Aktif",],
            ["nim"=> "2401012",
            "nama"=> "Dewi Lestari",
            "angkatan"=> 2023,
            "email"=> "dewi.lestari@contoh.ac.id",
            "status"=> "Drop Out",],
            ["nim"=> "2401020",
            "nama"=> "Rizky Pratama",
            "angkatan"=> 2022,
            "email"=> "rizky.pratama@contoh.ac.id",
            "status"=> "Lulus",],
            
        ];
        return view("mahasiswa.index", compact("kolom","mahasiswa"));
    }

    public function show(string $nim):View
    {
        $mahasiswa = [
            ["nim"=> "2401001","nama"=> "Ahmad Fauzi","angkatan"=> 2024,
            "email"=> "ahmat.fauzi@contoh.ac.id","status"=> "Aktif",],
            ["nim"=> "2401002","nama"=> "Siti Rahmawati","angkatan"=> 2024,
            "email"=> "siti.rahmawati@contoh.ac.id","status"=> "Aktif",],
            ["nim"=> "2401005","nama"=> "Budi Santoso","angkatan"=> 2023,
            "email"=> "budi.santoso@contoh.ac.id","status"=> "Aktif",],
            ["nim"=> "2401012","nama"=> "Dewi Lestari","angkatan"=> 2023,
            "email"=> "dewi.lestari@contoh.ac.id","status"=> "Drop Out",],
            ["nim"=> "2401020","nama"=> "Rizky Pratama","angkatan"=> 2022,
            "email"=> "rizky.pratama@contoh.ac.id","status"=> "Lulus",],            
        ];

        $detail = collect($mahasiswa)->firstWhere('nim', $nim);

        if (!$detail) abort(404);

        return view('mahasiswa.show', compact('detail'));
    }
}
