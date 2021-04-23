<!DOCTYPE html>
<html lang="vi">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    {!! SEOMeta::generate() !!}
    <link href="{{ mix("css/master.css") }}" rel="stylesheet" />
    <link href="{{ asset('/assets/css/style.css?v=1.0.0') }}" rel="stylesheet" />
    @yield('styles')
</head>
<body class="c-app">
    @include('layouts.master-sidebar')
    <div class="c-wrapper c-fixed-components">
        @include('layouts.master-header')
        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    <div class="fade-in">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
        @yield('footer')
    </div>

    <div id="loading" class="loading">
        <div class="wrapper">
            <img src="{{ asset('/assets/images/icon-loading.gif') }}" class="icon" alt="Loading" />
        </div>
    </div>
    <script src="{{ mix('/js/master.js') }}"></script>
    <script src="{{ asset('/assets/js/script.js?v=1.0.0') }}"></script>
    @yield('scripts')
</body>
</html>
