<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

  @include('shared.metatags')

  <title>Подключение Bootstrap</title>
</head>
    <body>

        @yield('header')
        @yield('content')

            <a href="/">Back</a>

    </body>
</html>
