<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/fetch-and-store',[PersonController::class, 'fetchAndUpdate']);
Route::get('/scantwo',[PersonController::class, 'updateScan']);


Route::get('/missing',[PersonController::class, 'fetchMissingPersons']);
