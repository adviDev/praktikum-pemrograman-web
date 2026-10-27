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
        User::updateOrCreate(
            ['email' => 'dosen@siakad.test'], 
            [
                'name'     => 'Lindung Siswanto',
                'password' => Hash::make('123'),
                'role'     => 'dosen',
            ]
        );
        User::updateOrCreate(
            ['email' => 'mahasiswa@siakad.test'],
            [
                'name'     => 'Adytya Alviandhika',
                'password' => Hash::make('123'),
                'role'     => 'mahasiswa',
            ]
        );
    }
}
