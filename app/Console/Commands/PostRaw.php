<?php

namespace App\Console\Commands;

use function App\totalCollectedWithForeign;
use Illuminate\Console\Command;

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
     * @return mixed
     */
    public function handle()
    {
        $url = env('RAW_POST_URL');
        $total = \App\totalCollectedWithForeign();

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "total=$total");

        // in real life you should use something like:
        // curl_setopt($ch, CURLOPT_POSTFIELDS,
        //          http_build_query(array('postvar1' => 'value1')));

        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        curl_close ($ch);

        $this->info($server_output);

    }
}
