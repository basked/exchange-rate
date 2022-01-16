<?php

namespace App\Services;


use App\Contracts\Exchanger;
use App\Contracts\ExchangerContract;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;

class ExchangerNbrb implements ExchangerContract
{
    function getData($format = 'json')
    {

    }

}