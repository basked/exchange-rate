<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ExchangeSeeder extends Seeder
{
    private $base_url = 'https://www.nbrb.by/services/xmlexratesdyn.aspx?curId=%d&fromdate=%s&todate=%s';

    public function getXml($curr_id, $fromdate, $todate): string
    {
        $url = sprintf($this->base_url, $curr_id, $fromdate, $todate);
        try {
            $xml = Http::get($url)->body();
        } catch (GuzzleException $e) {
            $e->getMessage();
        }
        return $xml;
    }


    public function run()
    {
        DB::table('exchanges')->delete();
        $now = Carbon::now();
        // Begin date
        $weekStartDate = $now->startOfWeek()->format('m/d/Y');
        // End date
        $weekEndDate = $now->endOfWeek()->format('m/d/Y');
        $currencies = DB::table('currencies')->get(['id', 'CurrId']);
        foreach ($currencies as $currency) {
            $xml = $this->getXml($currency->CurrId, $weekStartDate, $weekEndDate);
            $exchanges = simplexml_load_string($xml)->xpath('Record');
            foreach ($exchanges as $exchange) {
                $data = [
                    'currency_id' => $currency->id,
                    'DateExch' => date('Y-m-d', strtotime((string)$exchange->attributes()['Date'])),
                    'Rate' => (float)$exchange->Rate,
                ];
                \App\Models\Exchange::factory()->create($data);
            }
        }
    }
}
