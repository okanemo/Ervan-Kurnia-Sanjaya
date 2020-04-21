<html>
    <head>
        <title>Okanemo - @yield('title')</title>
        <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('css/sweetalert.min.css') }}" rel="stylesheet">
        <link href="{{ url('css/dashboard.css') }}" rel="stylesheet">
    </head>
    <body>
        @include ('layouts.navbar')
        @include ('layouts.sidebar')
        
        <div class="container">
            @yield('content')
        </div>
    </body>

    <script type="text/javascript">
        var currentRoute = '{{ Route::currentRouteName() }}';
    </script>

    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/sweetalert.min.js') }}"></script>
    <script src="{{ url('js/dashboard.js') }}"></script>

    @yield('script')
</html>