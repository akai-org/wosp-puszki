<?php

namespace App\Console\Commands;

use App\Lib\AppStatusManager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

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
     */
    public function handle(): void
    {
        Log::info('Moneybox scrape ran');

        $moneyboxId = config('wosp.moneybox.id');
        $url = "https://eskarbonka.wosp.org.pl/$moneyboxId/stats";
        $result = Process::run("python3 moneyBoxScrapper.py $url");

        if (!$result->successful()) {
            Log::error('Could not fetch the moneybox value');
            $this->error('Could not fetch the moneybox value');
            return;
        }

        $amount = trim($result->output());

        Log::info('Moneybox scrape got '.$amount);
        $this->info('Moneybox scrape got '.$amount);
        
        AppStatusManager::saveStatusValue(AppStatusManager::MONEYBOX_VALUE, $amount);
        Log::info('Moneybox scrape finished');
        $this->info('Moneybox scrape finished');
    }
}
