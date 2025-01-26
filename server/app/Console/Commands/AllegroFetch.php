<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
class AllegroFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'allegro:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Returns current sum of allegro auctions and stores it in cache';
   /**
     * Create a new command instance.
     *
     * @var string
     */
    private static $url ='https://api.allegro.pl/sale/offers?sellingMode.format=AUCTION&limit=1000';
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
        $auth_token =  Cache::get('allegro_auth_token') ;
        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => self::$url,
            CURLOPT_HTTPHEADER => array('Accept: application/vnd.allegro.public.v1+json', 'Authorization: Bearer ' . $auth_token),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true
        ));
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);

        if($info['http_code'] == 401){
            $refresh_token = Cache::get('allegro_refresh_token');
            $auth_token = $this->TokenRefresh($refresh_token);
            Cache::put('allegro_auth_token', $auth_token, 43200);
            curl_setopt_array($ch, array(
                CURLOPT_URL => self::$url,
                CURLOPT_HTTPHEADER => array('Accept: application/vnd.allegro.public.v1+json','Authorization: Bearer ' . $auth_token),
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_RETURNTRANSFER => true
            ));
            $result = curl_exec($ch);
        }

        $info = curl_getinfo($ch);
        $sum = 0;
        if($info['http_code'] == 200){
            $decodedRequest = json_decode($result,true);
            var_dump(count($decodedRequest['offers']));
            foreach($decodedRequest['offers'] as $offer) {
                if ($offer['saleInfo']['biddersCount'] == 0) {
                    continue;
                }
                $sum += floatval($offer['saleInfo']['currentPrice']['amount']);
            }
            curl_close($ch);
        }
        Cache::put('allegro_sum', $sum, 3600);
        $this->info($sum);
    }

    protected function getCurl($headers, $url, $content = null) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true
        ));
        if ($content !== null) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        }
        return $ch;
    }

    function TokenRefresh($token) {
        $client_id = env('CLIENT_ID');
        $client_secret = env('CLIENT_SECRET');
        $authorization = base64_encode( $client_id.':'.$client_secret);
        $headers = array("Authorization: Basic {$authorization}","Content-Type: application/x-www-form-urlencoded");
        $content = "grant_type=refresh_token&refresh_token={$token}";
        $ch = $this->getCurl($headers, "https://allegro.pl/auth/oauth/token", $content);
        $tokenResult = curl_exec($ch);
        $resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($tokenResult === false || $resultCode !== 200) {
            exit ("Something went wrong: $resultCode | $tokenResult");
        }

        return json_decode($tokenResult)->access_token;
    }
}
