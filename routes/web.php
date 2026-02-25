<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotsController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\PartieController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('mots', MotsController::class);
Route::resource('joueurs', JoueurController::class);
Route::resource('parties', PartieController::class);
Route::resource('users', UserController::class);
