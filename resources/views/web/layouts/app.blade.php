<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    @include('web.includes.metas')

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    @stack('styles_top')
    @stack('scripts_top')


    @vite([
        // CSS
        'resources/css/user/app.css',
        'resources/css/user/extra.css',

        // JS
        'resources/js/user/main.js',
        'resources/js/user/scripts.js',
    ])

</head>

    <body class="
        @if(!request()->routeIs('web.index')) relative top-20 text-evisablack @endif
        font-inter
        ">

        @include('web.includes.header')

        @yield('content')

        @include('web.includes.footer')

        @stack('styles_bottom')
        @stack('scripts_bottom')

    </body>

</html>