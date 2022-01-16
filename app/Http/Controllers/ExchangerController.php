<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Exchange;
use Illuminate\Http\Request;

class ExchangerController extends Controller
{
    public function index()
    {  // Даты для отображения в шапке таблицы
        $exchDates = Exchange::get('DateExch')->unique('DateExch')->sortBy('DateExch');;
       // Данные по валютам
        $currencies = Currency::with('exchanges')->get()->sortBy('Name')->sortBy('DateExch');
        return view('exchanges.index', ['currencies' => $currencies, 'exchDates' => $exchDates]);
    }
}