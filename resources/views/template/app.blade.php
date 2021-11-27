<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env("APP_NAME") }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
    <body class="bg-gray-800">
        <div id="app">
            <navigation></navigation>

            @yield('content')
        </div>
    </body>

    <script src="{{ asset('js/app.js') }}"></script>
</html>

