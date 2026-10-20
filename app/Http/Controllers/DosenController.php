<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DosenController extends Controller
{
public function index():View
    {
        $kolom = [
            "nidn"=> "nidn",
            "namaDosen"=> "nama dosen",
            "keahlian"=> "bidang keahlian",
            "status"=> "status",
        ];

        $dosen = [
            ["nidn"=> "0012038801",
            "namaDosen"=> "Hendra Wijaya",
            "keahlian"=> "Pemrograman Web",
            "status"=> "Aktif",],
            ["nidn"=> "0015048702",
            "namaDosen"=> "Maya Sari",
            "keahlian"=> "Basis Data",
            "status"=> "Aktif",],
            ["nidn"=> "0021058503",
            "namaDosen"=> "Andi Kurniawan",
            "keahlian"=> "Jaringan Komputer",
            "status"=> "Aktif",],
            ["nidn"=> "0008037904",
            "namaDosen"=> "Rina Marlina",
            "keahlian"=> "Rekayasa Perangkat Lunak",
            "status"=> "Tugas Belajar",],
        ];

        return view("dosen.index", compact("kolom","dosen"));
    }
}
