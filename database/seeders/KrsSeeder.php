<?php

namespace Database\Seeders;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswas = Mahasiswa::orderBy('id')->limit(10)->get();

        foreach ($mahasiswas as $mhs) {
            $krs = Krs::firstOrCreate([
                'mahasiswa_id'   => $mhs->id,
                'tahun_akademik' => '2026/2027',
                'semester'       => 'Ganjil',
            ]);

            $mataKuliahIds = MataKuliah::inRandomOrder()->limit(5)->pluck('id');

            $krs->mataKuliah()->detach();
            $krs->mataKuliah()->attach($mataKuliahIds);
        }
    }
}
