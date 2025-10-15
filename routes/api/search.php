<?php

use App\Http\Controllers\Api\SearchController;
use Illuminate\Support\Facades\Route;

Route::prefix('search')->group(function () {

    // POST api/search
    Route::post('/', [SearchController::class, 'index'])
        ->name('api.search.index');

    // POST api/search/seats
    Route::post('/seats', [SearchController::class, 'seats'])
        ->name('api.search.seats');
});