<?php

namespace App\Contracts;

interface ExchangerContract
{
    function getData($format='json');
    function exportData($format='array');
}