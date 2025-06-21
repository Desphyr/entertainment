<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GameController; 

Route::get('/', function () {
    return redirect()->route('films.index');
});

Route::resource('films', FilmController::class);
Route::resource('games', GameController::class);
