<?php

namespace App\Console\Commands;

use App\Lib\AppStatusManager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ScrapMoneyBox extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:moneybox {browser=firefox}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrap the current moneybox value and save to DB';

    /**
     * The supported browsers
     *
     * @var array
     */
    protected $browsers = [
        'firefox' => 'Symfony\\Component\\Panther\\Client::createFirefoxClient',
        'chrome' => 'Symfony\\Component\\Panther\\Client::createChromeClient'
    ];

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
        Log::info('Moneybox scrape ran');
        $moneyboxId = config('wosp.moneybox.id');
        $moneyboxValueSelector = config('wosp.moneybox.selector');
        $url = 'https://eskarbonka.wosp.org.pl/' . $moneyboxId;

        // Create the browser client as specified in an argument
        $browser = $this->argument('browser');
        if(isset($this->browsers[$browser])){
            $client = $this->browsers[$browser](
                [
                    'port' => random_int(4000, 5000), // defaults to 9080
                ]
            );
        }else{
            $this->error($browser . ' is not a supported browser.');
            $this->info('Supported browsers: ' . implode(', ', array_keys($this->browsers)));
            return;
        }

        $client->request('GET', $url);

        // Wait for an element to be present in the DOM (even if hidden)
        $crawler = $client->waitFor($moneyboxValueSelector);
        $moneyInBox = $crawler->filter($moneyboxValueSelector)->text();

        $matches = [];
        $result = preg_match('/[ \d]+([,.]\d{,2})?/', $moneyInBox, $matches);
        if($result !== 1){
            Log::error('Could not fetch the moneybox value');
            $this->error('Could not fetch the moneybox value');
        }else{
            // Normalize the decimal point to full stop and not comma and remove spaces from inside
            $normalizedAmount = str_replace([ ',', ' ' ], [ '.', '' ], $matches[0]);
            Log::info('Moneybox scrape got ' . $normalizedAmount);
            AppStatusManager::saveStatusValue(AppStatusManager::MONEYBOX_VALUE, $normalizedAmount);
        }
        Log::info('Moneybox scrape finished');
    }
}
