<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\jadwalController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/jadwal', [jadwalController::class, 'index']);