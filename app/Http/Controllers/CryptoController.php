<?php

namespace App\Http\Controllers;

use App\Services\CoinMarketCapService;
use Illuminate\Http\Request;

class CryptoController extends Controller
{
    protected $coinService;

    public function __construct(CoinMarketCapService $coinService)
    {
        $this->coinService = $coinService;
    }

    public function index()
    {
        $data = $this->coinService->getLatestListings();
        return view('crypto.index', compact('data'));
        // return response()->json($data);
    }

    public function getData(Request $request)
    {
        $symbol = $request->query('symbol');

        $data = $this->coinService->getCryptoQuote($symbol);
        return response()->json($data);
    }
}