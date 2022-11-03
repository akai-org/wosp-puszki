<?php

namespace App\Console\Commands;

use function App\totalCollectedWithForeign;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

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
     * @return mixed
     */
    public function handle()
    {
        $url = env('JSON_POST_URL');
        $totalArr = \App\totalCollectedReal();
        $ch = curl_init();
        $client = new Client();

        $r = $client->request('POST', $url, [
            'body' => json_encode($totalArr),
            'verify' => false
        ]);


        // in real life you should use something like:
        // curl_setopt($ch, CURLOPT_POSTFIELDS,
        //          http_build_query(array('postvar1' => 'value1')));

        // receive server response ...


        $this->info('Request success ' . $url);

    }
}
