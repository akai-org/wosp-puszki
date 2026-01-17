<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class PostJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post json to external server';

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
        $url = config('services.json_post.url');
        $totalArr = \App\totalCollectedReal();
        $ch = curl_init();
        $client = new Client;

        $r = $client->request('POST', $url, [
            'body' => json_encode($totalArr),
            'verify' => false,
        ]);

        $this->info('Request success '.$url);
    }
}
