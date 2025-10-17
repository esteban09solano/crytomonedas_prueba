<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CoinMarketCapService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('coinmarketcap.base_url');
        $this->apiKey  = config('coinmarketcap.api_key');
    }

    public function getLatestListings()
    {
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $this->apiKey,
            'Accept' => 'application/json',
        ])->get("{$this->baseUrl}/cryptocurrency/listings/latest", [
            // 'limit' => $limit,
            'convert' => 'USD'
        ]);

        return $response->json();
    }

    public function getCryptoQuote($symbol)
    {
        if ($symbol == "all") {
            $response = Http::withHeaders([
                'X-CMC_PRO_API_KEY' => $this->apiKey,
                'Accept' => 'application/json',
            ])->get("{$this->baseUrl}/cryptocurrency/listings/latest", [
                // 'limit' => $limit,
                'convert' => 'USD'
            ]);
        } else {
            $response = Http::withHeaders([
                'X-CMC_PRO_API_KEY' => $this->apiKey,
                'Accept' => 'application/json',
            ])->get("{$this->baseUrl}/cryptocurrency/quotes/latest", [
                'symbol' => $symbol,
            ]);
        }

        return $response->json();
    }

    public function getCryptoHistorical($symbol, $timeStart, $timeEnd)
    {
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $this->apiKey,
            'Accept' => 'application/json',
        ])->get("{$this->baseUrl}/cryptocurrency/quotes/historical", [
            'symbol' => $symbol,
            'time_start' => $timeStart,
            'time_end' => $timeEnd,
            'interval' => 'daily',
            'convert' => 'USD'
        ]);

        return $response->json();
    }
}