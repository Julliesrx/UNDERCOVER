<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotsController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\PartieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaisonController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('mots', MotsController::class);
Route::resource('joueurs', JoueurController::class);
Route::resource('parties', PartieController::class);
Route::resource('users', UserController::class);
Route::resource('saisons', SaisonController::class);

Route::patch('users/{id}/ban', [UserController::class, 'ban'])->name('users.ban');
Route::patch('joueurs/{id}/reset', [JoueurController::class, 'resetScore'])->name('joueurs.resetScore');
Route::patch('saisons/{id}/cloturer', [SaisonController::class, 'cloturer'])->name('saisons.cloturer');