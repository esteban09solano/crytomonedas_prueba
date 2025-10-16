@extends('layouts.main')

@section('content')
<h1>Hola estamos en página</h1>
<p>Listado de criptomonedas:</p>
<select name="" id="">

    <option value="">Seleccione una criptomoneda</option>
    @foreach ($data['data'] as $crypto)
    <option value="{{ $crypto['symbol'] }}">{{ $crypto['name'] }}</option>
    @endforeach
</select>



<section style="width: 75%; margin: auto;">
    <canvas id="cryptoChart" width="400" height="200"></canvas>

</section>

@endsection