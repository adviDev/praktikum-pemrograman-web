<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                "email"=> "admin@siakad.test",
            ],
            [
                "name"=> "Administrator SIAKAD",
                "password"=> Hash::make("Admin@12345"),
                "role"=> "admin",
            ]
        );
    }
}
