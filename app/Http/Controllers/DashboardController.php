<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // 1. Data Card Statistik
        $totalKrs = Krs::count();
        $rataRataSks = $totalKrs > 0 
            ? round(Krs::withSum('mataKuliah', 'sks')->get()->avg('mata_kuliah_sum_sks') ?? 0) 
            : 0;

        $statistik = [
            [
                "judul"  => "Mahasiswa", 
                "jumlah" => Mahasiswa::count(),
                "icon"   => "bi-mortarboard-fill", 
                "warna"  => "primary",
            ],
            [
                "judul"  => "Dosen", 
                "jumlah" => Dosen::count(),
                "icon"   => "bi-person-badge-fill", 
                "warna"  => "success",
            ],
            [
                "judul"  => "Mata Kuliah", 
                "jumlah" => MataKuliah::count(),
                "icon"   => "bi-book-fill", 
                "warna"  => "warning",
            ],
            [
                "judul"  => "KRS Aktif", 
                "jumlah" => Krs::where('status', 'disetujui')->count(),
                "icon"   => "bi-journal-check", 
                "warna"  => "info",
            ],
            [
                "judul"  => "Rata-Rata SKS per KRS", 
                "jumlah" => $rataRataSks,
                "icon"   => "bi-journal-text", 
                "warna"  => "dark",
            ],
        ];

        // 2. Data Tabel KRS Terbaru (5 data terakhir)
        $kolomKrs = [
            "nim"    => "NIM",
            "nama"   => "Nama Mahasiswa",
            "sks"    => "SKS",
            "status" => "Status",
        ];

        $krsTerbaru = Krs::with(['mahasiswa', 'mataKuliah'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    "nim"    => $item->mahasiswa?->nim ?? '-',
                    "nama"   => $item->mahasiswa?->nama ?? '-',
                    "sks"    => $item->mataKuliah->sum('sks'),
                    "status" => ucfirst($item->status),
                ];
            })
            ->toArray();

        // 3. Status KRS (Persentase Dinamis)
        $disetujui = Krs::where('status', 'disetujui')->count();
        $menunggu  = Krs::where('status', 'diajukan')->count();
        $ditolak   = Krs::where('status', 'ditolak')->count();

        $statusKrs = [
            [
                "label"  => "Disetujui", 
                "persen" => $totalKrs > 0 ? round(($disetujui / $totalKrs) * 100) : 0, 
                "warna"  => "success"
            ],
            [
                "label"  => "Menunggu", 
                "persen" => $totalKrs > 0 ? round(($menunggu / $totalKrs) * 100) : 0, 
                "warna"  => "warning"
            ],
            [
                "label"  => "Ditolak", 
                "persen" => $totalKrs > 0 ? round(($ditolak / $totalKrs) * 100) : 0, 
                "warna"  => "danger"
            ],
        ];

        return view("dashboard", compact(
            "statistik", "kolomKrs", "krsTerbaru", "statusKrs"
        ));
    }
}