<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CurrencyCollection;
use Illuminate\Support\Facades\Redis;

class ExchangeController extends Controller
{
    private $redis;


    public function __construct()
    {
        $this->redis = Redis::connection()->client();
    }

    public function index(): CurrencyCollection
    {
        $active_currencies = json_decode($this->redis->get('active_currencies'));
        if ($active_currencies === null) {
            $active_currencies = DB::table('currencies')
                ->distinct()
                ->rightJoin('exchanges', 'currencies.id', '=', 'exchanges.currency_id')
                ->select('exchanges.currency_id')
                ->get()->pluck('currency_id');
            $this->redis->set('active_currencies', $active_currencies);
        };
        $data = json_decode($this->redis->get('data'));
        if ($data === null) {
            $data = Currency::with('exchanges')
                ->whereIn('id', $active_currencies)
                ->get()
                ->sortBy('Name')
                ->sortBy('exchanges.DateExch');
            $this->redis->set('data', $data);
        }
        // Выводм ввиде JSON
        return new CurrencyCollection($data);
    }

}
