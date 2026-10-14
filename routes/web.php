<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/beranda', [BerandaController::class,'index'])->name('beranda');
