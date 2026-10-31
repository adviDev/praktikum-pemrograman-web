<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PenggunaController extends Controller
{
    //
    public function index():View
    {
        $kolom = [
            "name"=> "Nama",
            "email"=> "Email",
            "role"=> "Peran",
        ];

        $pengguna = User::orderBy('name')
            ->get(['name','email','role'])
            ->toArray();

        return view('pengguna.index', compact('kolom','pengguna'));
    }

}
