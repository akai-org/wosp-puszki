<?php

namespace App\Console\Commands;

use App\Lib\AppStatusManager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
class allegroAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'allegroAPI:GetAucSum';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'returns current sum of allegro auctions and stores it in cache';
   /**
     * Create a new command instance.
     *
     * @var string
     */
    private static $url ='https://api.allegro.pl/sale/offers?sellingMode.format=%22AUCTION%22';
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
        $sum=0;     
        
        $auth_token =  Cache::get('allegro_auth_token') ;
        $ch = curl_init();
     

        curl_setopt_array($ch, array(
            CURLOPT_URL => self::$url,
            CURLOPT_HTTPHEADER => array('Accept: application/vnd.allegro.public.v1+json','Authorization: Bearer '.$auth_token),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true
        ));
        $result = curl_exec($ch);
        $info=curl_getinfo($ch);
       
        if($info['http_code']==401){
            $refresh_token=Cache::get('allegro_refresh_token');
            $auth_token=$this->TokenRefresh($refresh_token);
            Cache::put('allegro_auth_token',$auth_token,43200);
            curl_setopt_array($ch, array(
                CURLOPT_URL => self::$url,
                CURLOPT_HTTPHEADER => array('Accept: application/vnd.allegro.public.v1+json','Authorization: Bearer '.$auth_token),
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_RETURNTRANSFER => true
            ));
            $result = curl_exec($ch);

        }
        $info=curl_getinfo($ch);
        if($info['http_code']==200){
        $var =json_decode($result,true);
        var_dump($var);
        foreach( $var['items'] as $key => $value ) {
            foreach( $value as $key2 => $value2 ){
                foreach( $value2 as $key3 => $value3 ){
                    $sum+=floatval($value2['sellingMode']['price']['amount']);
                }
            }

        }
        curl_close($ch);
        Cache::put('allegro_auc_sum',$sum,3600);
    }

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
        $client_id=env('CLIENT_ID');
        $client_secret=env('CLIENT_SECRET');
        $authorization = base64_encode( $client_id.':'.$client_secret);
        $headers = array("Authorization: Basic {$authorization}","Content-Type: application/x-www-form-urlencoded");
        $content = "grant_type=refresh_token&refresh_token={$token}&redirect_uri=http://localhost:8000/allegro";
        $ch = $this->getCurl($headers, $content);
        $tokenResult = curl_exec($ch);
        $resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($tokenResult === false || $resultCode !== 200) {
            exit ("Something went wrong:  $resultCode $tokenResult");
        }
    
        return json_decode($tokenResult)->access_token;
    }
}
