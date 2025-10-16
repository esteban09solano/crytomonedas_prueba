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
}