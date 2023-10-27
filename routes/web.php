<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\jadwalController;
Route::get('/', function () {
    return view('welcome');
});
 
Route::get('/test/{id}', function ($id) {
    return 'Params : '.$id;
})->where("id","\d+");

Route::get('/index', function (){
    return "
<a class='bg-black' href='".route('create')."'>Go Create</a>
    ";
});

Route::get('/create', function (){
    return 'Create Successfully';
})->name("create") ;




Route::get('/jadwal', [jadwalController::class, 'index']);