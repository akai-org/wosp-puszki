<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function App\totalCollectedReal;

class PostRaw extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:raw';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post raw to external server';

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
    public function handle(): void
    {
        $url = config('services.external_post.raw_url');
        $totalArr = totalCollectedReal();
        $total = $totalArr['amount_total_in_PLN'];
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "total=$total");

        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);

        $this->info($server_output);

    }
}
