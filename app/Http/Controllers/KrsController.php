<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class KrsController extends Controller
{
    public function index():View
    {
        $kolom = [ 
            "nim"=> "nim",
            "nama"=> "nama mahasiswa",
            "semester"=> "semester",
            "sks"=> "total sks",
            "status"=> "status",
        ];

        $krs = [
            [
                "nim"=> "2401001",
                "nama"=> "Ahmad Fauzi",
                "semester"=> "2",
                "sks"=> "22",
                "status"=> "Disetujui",
            ],
            [
                "nim"=> "2401002",
                "nama"=> "Siti Rahmawati",
                "semester"=> "2",
                "sks"=> "20",
                "status"=> "Disetujui",
            ],
            [
                "nim"=> "2401005",
                "nama"=> "Budi Santoso",
                "semester"=> "4",
                "sks"=> "24",
                "status"=> "Menunggu",
            ],
            [
                "nim"=> "24010012",
                "nama"=> "Dewi Lestari",
                "semester"=> "4",
                "sks"=> "18",
                "status"=> "Menunggu",
            ],
        ];
    return view("krs.index", compact("kolom","krs"));
    }
}
