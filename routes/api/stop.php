<?php

use App\Http\Controllers\Api\StopController;
use Illuminate\Support\Facades\Route;

Route::prefix('stop')->group(function () {

    // GET api/stops
    Route::get('/', [StopController::class, 'index'])
        ->name('api.stops.index');
});