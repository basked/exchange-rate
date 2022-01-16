<?php

namespace App\Console\Commands;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\ExchangeSeeder;

use http\Env;
use Illuminate\Console\Command;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ImportExchangeRates extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:ExchRates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command imports exchange rates from http://nbrb.by/Services/XmlExRates.aspx';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $ds= new DatabaseSeeder();
        $this->info('Import all currencies...');
        $ds->call( CurrencySeeder::class);
        $this->info('Import all exchange rates...');
        $ds->call( ExchangeSeeder::class);

        $this->info('Done');
        $this->info('1) Set in TrustProxies.php prtoperty  $proxies = * ');
        $this->info('2) Run command: sail share --subdomain=echange-rates');
        $this->info('3) Visit site http://echange-rates.laravel-sail.site:8080/');

        return 0;
    }
}
