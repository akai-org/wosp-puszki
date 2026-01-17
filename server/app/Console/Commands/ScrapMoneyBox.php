<?php

namespace App\Console\Commands;

use App\Lib\AppStatusManager;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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
     * @throws GuzzleException
     */
    public function handle(): void
    {
        Log::info('Moneybox scrape ran');
        $moneyboxId = config('wosp.moneybox.id');
        $moneyboxValueSelector = config('wosp.moneybox.selector');
        $url = 'https://eskarbonka.wosp.org.pl/' . $moneyboxId;

        $client = new Client(['verify' => false]);
        $result = $client->get($url);


        $matches = [];
        $pattern = '/data-count_start="(\d+)"/';

        // Perform the regex match
        if (!preg_match($pattern, $result->getBody()->getContents(), $matches)) {
            Log::error('Could not fetch the moneybox value');
            $this->error('Could not fetch the moneybox value');
            return;
        }

        $data_count_start = $matches[1];
        echo "The value of data-count_start is: " . $data_count_start;

        // Normalize the decimal point to full stop and not comma and remove spaces from inside
        $normalizedAmount = str_replace([',', ' '], ['.', ''], $data_count_start);
        Log::info('Moneybox scrape got ' . $normalizedAmount);
        $this->info('Moneybox scrape got ' . $normalizedAmount);
        AppStatusManager::saveStatusValue(AppStatusManager::MONEYBOX_VALUE, $normalizedAmount);
        Log::info('Moneybox scrape finished');
        $this->info('Moneybox scrape finished');
    }
}
