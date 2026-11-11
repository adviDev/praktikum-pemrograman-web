<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BerandaController extends Controller
{
    //
    public function index(): View
    {
        $versiMysql = DB::selectOne("select version() as versi")->versi;

        return view('beranda', [
            'namaAplikasi' => config('app.name'),
            // 'namaAplikasi' => "<script>alert(1)</script>",
            // 'versiLaravel'=> app()-> version(),
            'versiLaravel'=> "<script>alert(1)</script>",
            'versiPhp'=> PHP_VERSION,
            'versiMysql'=> $versiMysql,
            'namaDatabase' => DB::getDatabaseName(),
            'waktu'=> now()->translatedFormat('l, d F Y H:i'),
        ]);
    }
}
