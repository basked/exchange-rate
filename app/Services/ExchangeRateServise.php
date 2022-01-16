<?php

namespace App\Services;

use App\Contracts\Exchanger;
use App\Contracts\ExchangerContract;

class ExchangeRateServise
{
    private $exchanger;

    public function __construct(ExchangerContract $exchanger)
    {
        $this->exchanger = $exchanger;
    }

    public function export()
    {
        return $this->exchanger->getData();
    }

}