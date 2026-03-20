<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MotsController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\PartieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaisonController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::resource('parties', PartieController::class)->only(['destroy']);
    Route::resource('saisons', SaisonController::class)->except(['show']);

    Route::patch('users/{id}/ban', [UserController::class, 'ban'])->name('users.ban');
    Route::patch('joueurs/{id}/reset', [JoueurController::class, 'resetScore'])->name('joueurs.resetScore');
    Route::patch('saisons/{id}/cloturer', [SaisonController::class, 'cloturer'])->name('saisons.cloturer');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function() {
        return view('home');
    })->name('home');

    Route::resource('users', UserController::class)->only(['show', 'edit', 'update']);
    Route::resource('joueurs', JoueurController::class);
    Route::resource('mots', MotsController::class);
    Route::resource('parties', PartieController::class)->only(['index', 'show', 'create', 'store']);
    Route::resource('saisons', SaisonController::class)->only(['show']);
});