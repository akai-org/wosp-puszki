<?php

namespace App\Console\Commands;

use App\Lib\AppStatusManager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PHPHtmlParser\Dom;
use GuzzleHttp\Client;

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

        $client = new \GuzzleHttp\Client(['verify' => false]);
        $result = $client->get($url);



//        // Create the browser client as specified in an argument
//        $browser = $this->argument('browser');
//        if(isset($this->browsers[$browser])){
//            $client = $this->browsers[$browser](
////                [
////                    'port' => random_int(4000, 5000), // defaults to 9080
////                ]
//            );
//        }else{
//            $this->error($browser . ' is not a supported browser.');
//            $this->info('Supported browsers: ' . implode(', ', array_keys($this->browsers)));
//            return;
//        }

//        $response = $client->request('GET', $url);

//        $dom = new Dom;
//        $dom->loadStr($result->getBody()->getContents());
//        $moneyInBox = $dom->find($moneyboxValueSelector);
//        foreach ($moneyInBox as $item) {
//            dd($item->children);
//        }

//        dd($moneyInBox);
//
//        // Wait for an element to be present in the DOM (even if hidden)
//        $crawler = $client->waitFor($moneyboxValueSelector);
//        $moneyInBox = $crawler->filter($moneyboxValueSelector)->text();

        $matches = [];
        $pattern = '/data-count_start="(\d+)"/';

// Perform the regex match
        if (preg_match($pattern, $result->getBody()->getContents(), $matches)) {
            $data_count_start = $matches[1];
            echo "The value of data-count_start is: " . $data_count_start;
        } else {
            Log::error('Could not fetch the moneybox value');
            $this->error('Could not fetch the moneybox value');
        }
//        $result = preg_match('/[ \d]+([,.]\d{,2})?/', $moneyInBox, $matches);
//        dd($matches);
            // Normalize the decimal point to full stop and not comma and remove spaces from inside
            $normalizedAmount = str_replace([ ',', ' ' ], [ '.', '' ], $data_count_start);
//            dd($normalizedAmount, $matches);
            Log::info('Moneybox scrape got ' . $normalizedAmount);
            $this->info('Moneybox scrape got ' . $normalizedAmount);
            AppStatusManager::saveStatusValue(AppStatusManager::MONEYBOX_VALUE, $normalizedAmount);
        Log::info('Moneybox scrape finished');
        $this->info('Moneybox scrape finished');

    }
}
