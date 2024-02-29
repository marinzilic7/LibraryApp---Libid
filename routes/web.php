<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/registracija',[UserController::class,'registracija']);
Route::post('/prijava',[UserController::class,'prijava']);
Route::get('/prijavljen',[UserController::class,'prijavljen']);
Route::post('/odjava',[UserController::class,'odjava']);

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '^(?!api).*$');



