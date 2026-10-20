<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MatakuliahController extends Controller
{
    public function index(): View
    {
        $kolom =[
            "kode"=> "kode",
            "namaMatkul"=> "nama mata kuliah",
            "sks"=> "sks",
            "semester"=> "semester",
            "jenis"=> "jenis",
        ];

        $matakuliah = [
            [
                "kode"=> "TIF201",
                "namaMatkul"=> "Pemrograman Web",
                "sks"=> "3",
                "semester"=> "3",
                "jenis"=> "Praktik",
            ],
            [
                "kode"=> "TIF202",
                "namaMatkul"=> "Basis Data",
                "sks"=> "3",
                "semester"=> "2",
                "jenis"=> "Praktik",
            ],
            [
                "kode"=> "TIF301",
                "namaMatkul"=> "Rekayasa Perangkat Lunak",
                "sks"=> "3",
                "semester"=> "4",
                "jenis"=> "Teori",
            ],
            [
                "kode"=> "TIF302",
                "namaMatkul"=> "Jaringan Komputer",
                "sks"=> "2",
                "semester"=> "3",
                "jenis"=> "Teori",
            ],
        ];

    return view("matakuliah.index", compact("kolom","matakuliah"));
    }
}
