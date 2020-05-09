<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">

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
    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">

        <main class="">
        @if (session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @endif
            @yield('content')
        </main>
    </div>

    @if(Auth::check())
        <div  id="Group{{ $group }}" class="navbar"></div>
        @if( $groupdetails->group_user_id_1 == Auth::id() )
            <div id="Group_number1" class="navbar" ></div>
        @endif
        @if( $groupdetails->group_user_id_2 == Auth::id() )
            <div id="Group_number2" class="navbar" ></div>
        @endif
        @if( $groupdetails->group_user_id_3 == Auth::id() )
            <div id="Group_number3" class="navbar" ></div>
        @endif
        @if( $groupdetails->group_user_id_4 == Auth::id() )
            <div id="Group_number4" class="navbar" ></div>
        @endif
            <script src="{{ asset('js/isCount.js') }}"></script>
            <script src="{{ asset('js/isCountInRoomsUsersDetails.js') }}"></script>
    @endif

</body>
</html>