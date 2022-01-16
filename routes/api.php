<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExchangeController;

Route::get('/exchanges',[ExchangeController::Class,'index']);
