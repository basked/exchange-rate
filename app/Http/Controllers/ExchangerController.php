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
        $this->redis =  Redis::connection()->client();
    }

    public function index()
    {
        // Даты для отображения в шапке таблицы
        $date_exchanges = Exchange::get('DateExch')->unique('DateExch')->sortBy('DateExch');
        // Данные по валютам
        $currencies = Currency::with('exchanges')->get()->sortBy('Name')->sortBy('DateExch');
        return view('exchanges.index', ['currencies' => $currencies, 'exchDates' => $date_exchanges ]);
    }

    public function redis()
    {

//        $this->redis->del('exchDates');
//        $this->redis->del('currencies');

        // Даты для отображения в шапке таблицы
        $date_exchanges  = json_decode($this->redis->get('exchDates'));
        if ( $date_exchanges  === null) {
            $date_exchanges  = Exchange::get('DateExch')->unique('DateExch')->sortBy('DateExch');
            $this->redis->set('exchDates',  $date_exchanges );
        };

        $currencies = json_decode($this->redis->get('currencies'));
        if ($currencies === null) {
            $currencies = Currency::with('exchanges')->get()->sortBy('Name')->sortBy('DateExch');
            $this->redis->set('currencies', $currencies);
        };
        return view('exchanges.index', ['currencies' => $currencies, 'exchDates' => $date_exchanges ]);
    }
}
