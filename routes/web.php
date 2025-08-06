<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\PairingController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('event', EventController::class);
    Route::get('event/{event}/players', [PlayerController::class, 'index'])->name('player.index');
    Route::get('event/{event}/players/create', [PlayerController::class, 'create'])->name('player.create');
    Route::post('event/{event}/players', [PlayerController::class, 'store'])->name('player.store');
    Route::resource('player',  PlayerController::class)->except(['index', 'create', 'store']);


    Route::get('/pairing/{event}', [PairingController::class, 'index'])->name('pairing.index');

    Route::post('/pairing/set', [PairingController::class, 'set'])->name('pairing.set');

    Route::post('/pairing/remove', [PairingController::class, 'remove'])->name('pairing.remove');
});

require __DIR__ . '/auth.php';
