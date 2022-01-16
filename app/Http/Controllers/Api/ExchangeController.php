<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CurrencyCollection;

class ExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Находим валюту, для которой существуют курсы
        $activeCurrencies = DB::table('currencies')
            ->distinct()
            ->rightJoin('exchanges', 'currencies.id', '=', 'exchanges.currency_id')
            ->select('exchanges.currency_id')
            ->get()->pluck('currency_id');
        // Выводм ввиде JSON
        return new CurrencyCollection(\App\Models\Currency::with('exchanges')
            ->whereIn('id', $activeCurrencies)
            ->get()->sortBy('Name')->sortBy('exchanges.DateExch'));
    }

}
