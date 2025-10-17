<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Consulta de Cryptomonedas</title>

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-br from-gray-900 via-gray-800 to-blue-900 text-gray-100">