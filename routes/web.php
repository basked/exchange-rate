<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\ExchangerController::class, 'index']);
