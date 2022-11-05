<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Panther\Client;

class ScrapMoneyBox extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:moneybox';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrap the current moneybox value and save to DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $moneyboxId = config('wosp.moneybox.id');
        $moneyboxValueSelector = config('wosp.moneybox.selector');
        $url = 'https://eskarbonka.wosp.org.pl/' . $moneyboxId;

        $client = Client::createFirefoxClient();
        // Or, alternatively use Chrome
        // $client = Client::createChromeClient();

        $client->request('GET', $url);

        // Wait for an element to be present in the DOM (even if hidden)
        $crawler = $client->waitFor($moneyboxValueSelector);
        $moneyInBox = $crawler->filter($moneyboxValueSelector)->text();

        $matches = [];
        $result = preg_match('/\d+([,.]\d{,2})?/', $moneyInBox, $matches);
        if($result !== 1){
            $this->error('Could not fetch the moneybox value');
        }else{
            $this->info($matches[0]);
        }
    }
}
