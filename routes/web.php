<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\ExchangerController::class, 'index'])->name('exchanges.index');
Route::get('/redis/{id?}', [\App\Http\Controllers\ExchangerController::class, 'redis']);
