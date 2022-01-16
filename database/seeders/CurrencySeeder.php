<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CurrencySeeder extends Seeder
{
    private $base_url = 'https://www.nbrb.by/services/xmlexratesref.aspx';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function getXml(): string
    {
        $url = sprintf($this->base_url);
        try {
            $xml = Http::get($url)->body();
        } catch (GuzzleException $e) {
            $e->getMessage();
        }
        return $xml;
    }

    public function run()
    {
        DB::table('currencies')->delete();
        $xml = $this->getXml();
        $currencies = simplexml_load_string($xml)->xpath('Currency');
        foreach ($currencies as $currency) {
            $data = [
                'CurrId' => (int)$currency->attributes()['Id'],
                'NumCode' => (string)$currency->NumCode,
                'CharCode' => (string)$currency->CharCode,
                'Scale' => (int)$currency->Scale,
                'Name' => (string)$currency->Name,
                'EnglishName' => (string)$currency->EnglishName,
                'ParentCode' => (int)$currency->ParentCode
            ];
            \App\Models\Currency::factory()->create($data);
        }

    }
}
