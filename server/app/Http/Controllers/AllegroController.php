<?php

namespace App\Http\Controllers;

use CurlHandle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AllegroController extends Controller
{
    public function setAuthToken(Request $request): void
    {
        $code = $request->code;
        $response = (string) $this->getAccessToken($code);
        $access_token = json_decode($response)->access_token;
        $refresh_token = json_decode($response)->refresh_token;
        echo 'access_token = ', $access_token;
        echo 'refresh_token = ', $refresh_token;
        Cache::put('allegro_auth_token', $access_token, 43200);
        Cache::put('allegro_refresh_token', $refresh_token, 43200);
    }

    protected function getAccessToken(string $authorization_code): string|true
    {
        $client_id = config('services.allegro.client_id');
        $client_secret = config('services.allegro.client_secret');
        $authorization = base64_encode($client_id.':'.$client_secret);
        $app_url = config('app.url');
        $authorization_code = urlencode($authorization_code);
        $headers = ["Authorization: Basic {$authorization}", 'Content-Type: application/x-www-form-urlencoded'];
        $content = "grant_type=authorization_code&code={$authorization_code}&redirect_uri=$app_url/allegro";
        $ch = $this->getCurl($headers, $content);
        $tokenResult = curl_exec($ch);
        $resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($tokenResult === false || $resultCode !== 200) {
            exit("Something went wrong $resultCode $tokenResult");
        }

        return $tokenResult;
    }

    /**
     * @param  array<int, string>  $headers
     */
    protected function getCurl(array $headers, string $content): CurlHandle
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://allegro.pl/auth/oauth/token',
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $content,
        ]);

        return $ch;
    }

    public function initAllegro(): RedirectResponse
    {
        $client_id = config('services.allegro.client_id');
        $app_url = config('app.url');

        return redirect("https://allegro.pl/auth/oauth/authorize?response_type=code&client_id=$client_id&redirect_uri=$app_url/allegro");
    }
}
