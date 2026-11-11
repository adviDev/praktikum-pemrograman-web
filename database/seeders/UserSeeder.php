<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (app()->isProduction()){
            $this->command?->warn("UserSeeder dilewati di production");
            return;
        }

        $akun = [
            ['dosen@siakad.test','Dosen Uji','Dosen@12345','dosen'],
            ['mahasiswa@siakad.test','mahasiswa uji','Mahasiswa@12345','mahasiswa'],
        ];
        
        foreach($akun as [$email,$nama,$password,$role]){
            User::updateOrCreate(
                ['email'=>$email],
                [
                    'name'=>$nama,
                    'password'=>Hash::make($password),
                    'role'=>$role
                ]
            );
        }
    }
}
