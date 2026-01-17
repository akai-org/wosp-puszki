<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AllegroController extends Controller
{
    public function setAuthToken(Request $request)
    {
        $code = $request->code;
        $response = $this->getAccessToken($code);
        $access_token = json_decode($response)->access_token;
        $refresh_token = json_decode($response)->refresh_token;
        echo 'access_token = ', $access_token;
        echo 'refresh_token = ', $refresh_token;
        Cache::put('allegro_auth_token', $access_token, 43200);
        Cache::put('allegro_refresh_token', $refresh_token, 43200);
    }

    protected function getAccessToken($authorization_code)
    {
        $client_id = config('services.allegro.client_id');
        $client_secret = config('services.allegro.client_secret');
        $authorization = base64_encode($client_id.':'.$client_secret);
        $authorization_code = urlencode($authorization_code);
        $headers = ["Authorization: Basic {$authorization}", 'Content-Type: application/x-www-form-urlencoded'];
        $content = "grant_type=authorization_code&code={$authorization_code}&redirect_uri=http://localhost:8000/allegro";
        $ch = $this->getCurl($headers, $content);
        $tokenResult = curl_exec($ch);
        $resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($tokenResult === false || $resultCode !== 200) {
            exit("Something went wrong $resultCode $tokenResult");
        }

        return $tokenResult;
    }

    protected function getCurl($headers, $content)
    {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => "https://allegro.pl/auth/oauth/token",
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $content
        ));
        return $ch;
    }
}
