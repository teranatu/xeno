<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <main class="py-4">
        @if (session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @endif
            @yield('content')
        </main>
    </div>

    @if(Auth::check())
        <div  id="Group{{ $group }}" class="navbar"></div>
        <script src="{{ asset('js/isCount.js') }}"></script>
    @for ($i = 1; $i < 11; $i++)
        @if ( Auth::user()->group_id == $i )
        <script src="{{ asset("js/isCountInRoomsUsersDetails_$i.js") }}"></script>
        @endif
    @endfor
    @endif

</body>
</html>