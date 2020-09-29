<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <title>Hexlet Blog - @yield('title')</title>

	@include('shared.metatags')
    </head>
    <body>
        <div class="container mt-4">
            <h1>@yield('header')</h1>
            <div>
                @yield('content')
            </div>
		<a href="/">Back</a>
        </div>
    </body>
</html>
