<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Exchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ExchangerController extends Controller
{
    private $redis;


    public function __construct()
    {
        $connection = Redis::connection();
        $this->redis = $connection->client();
    }

    public function index()
    {  // Даты для отображения в шапке таблицы
        $exchDates = Exchange::get('DateExch')->unique('DateExch')->sortBy('DateExch');
        // Данные по валютам
        $currencies = Currency::with('exchanges')->get()->sortBy('Name')->sortBy('DateExch');
        return view('exchanges.index', ['currencies' => $currencies, 'exchDates' => $exchDates]);
    }

    public function redis()
    {

//        $this->redis->del('exchDates');
//        $this->redis->del('currencies');

        // Даты для отображения в шапке таблицы
        $exchDates = json_decode($this->redis->get('exchDates'));
        if ($exchDates === null) {
            $exchDates = Exchange::get('DateExch')->unique('DateExch')->sortBy('DateExch');
            $this->redis->set('exchDates', $exchDates);
        };

        $exchDates = Exchange::get('DateExch')->unique('DateExch')->sortBy('DateExch');
        $currencies = json_decode($this->redis->get('currencies'));
        if ($currencies === null) {
            $currencies = Currency::with('exchanges')->get()->sortBy('Name')->sortBy('DateExch');
            $this->redis->set('currencies', $currencies);
        };
        return view('exchanges.index', ['currencies' => $currencies, 'exchDates' => $exchDates]);
    }
}