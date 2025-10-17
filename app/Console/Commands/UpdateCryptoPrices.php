<?php

namespace App\Console\Commands;

use App\Models\CryptoPrice;
use App\Services\CoinMarketCapService;
use Illuminate\Console\Command;

class UpdateCryptoPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crypto:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza los precios de criptomonedas desde CoinMarketCap';

    /**
     * Execute the console command.
     */
    public function handle(CoinMarketCapService $coinService)
    {
        $data = $coinService->getLatestListings();

        foreach ($data['data'] as $crypto) {
            CryptoPrice::create([
                'symbol' => $crypto['symbol'],
                'price' => $crypto['quote']['USD']['price'],
            ]);
        }

        $this->info('Precios de criptomonedas actualizados correctamente.');
    }
}