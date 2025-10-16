@extends('layouts.main')

@section('content')
<section class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-2xl shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Listado de criptomonedas:</h2>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <label for="cryptoSelector" class="text-gray-700 font-medium">
            Seleccione una criptomoneda:
        </label>
        <select id="cryptoSelector" class="w-full mt-2 p-3 rounded-lg border border-gray-300 bg-white text-gray-800
           shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500
           hover:border-blue-400 transition duration-200">
            <option value="" selected>Seleccione una criptomoneda</option>
            <option value="all" selected>Todas</option>
            @foreach ($data['data'] as $crypto)
            <option value="{{ $crypto['symbol'] }}">{{ $crypto['name'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="bg-gray-50 p-4 rounded-xl">
        <canvas id="cryptoChart" class="w-full h-64"></canvas>
    </div>

</section>

@endsection