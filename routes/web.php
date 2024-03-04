<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;

use Illuminate\Support\Facades\Route;


Route::post('/registracija',[UserController::class,'registracija']);
Route::post('/prijava',[UserController::class,'prijava']);
Route::get('/prijavljen',[UserController::class,'prijavljen']);
Route::post('/odjava',[UserController::class,'odjava']);
Route::get('/svikorisnici',[UserController::class,'dohvatikorisnike']);
Route::post('/izbrisiKorisnika/{id}',[UserController::class,'izbrisiKorisnika']);

Route::get('/kategorije', [CategoryController::class, 'kategorije']);
Route::post('/dodajKategoriju',[CategoryController::class,'dodajKategoriju']);
Route::post('/izbrisiKategoriju/{id}',[CategoryController::class,'izbrisiKategoriju']);


Route::post('/dodajKnjigu',[BookController::class,'dodajKnjigu']);
Route::get('/dohvatiKnjige', [BookController::class, 'dohvatiKnjige']);
Route::post('/izbrisiKnjigu/{id}',[BookController::class,'izbrisiKnjigu']);
Route::post('/urediKnjigu/{id}',[BookController::class,'urediKnjigu']);


Route::post('/dodajKosaricu/{id}',[CartController::class,'dodajKosaricu']);
Route::get('/dohvatiKosaricu', [CartController::class, 'dohvatiKosaricu']);
Route::post('/izbrisiKosaricu/{id}',[CartController::class,'izbrisiKosaricu']);



Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '^(?!api).*$');



