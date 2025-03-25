<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    @include('web.includes.metas')

    <!-- Scripts -->
    @foreach([ 
        '/css/user/jquery-ui.min.css',
        'css/user/extra.css', 
    ] as $asset)
            <link rel="stylesheet" href="{{ asset($asset) }}?=time{{ time() }}">
    @endforeach  

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.21.0/dist/jquery.validate.min.js"
        type="module"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" type="module"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    @stack('styles_top')
    @stack('scripts_top')

    <style type="text/tailwindcss">
        @theme {
            --font-inter: "Inter", "sans-serif";
            --color-evisablue: oklch(43.72% 0.24865432609267016 263.90946967489356);
            --color-evisalightblue: oklch(64.05% 0.19156302486014723 268.01682615416854);
            --color-evisapeach: oklch(95.48% 0.027 56.77);
            --color-evisaorange: oklch(70.28% 0.1816 45.86);
            --color-evisapink: oklch(93.87% 0.0308 17.71);
            --color-evisasky: oklch(94.79% 0.0251 255.56);
            --color-evisasalad: oklch(97.3% 0.0463 144.24);
            --color-evisamedium: oklch(62.68% 0 0);
            --color-evisalight: oklch(86.07% 0 0);
            --color-evisasuperlight: oklch(95.21% 0 0);
            --color-evisablack: oklch(24.35% 0 0);
            --color-evisablackhover: oklch(51.03% 0 0);
            --color-evisabluekhover: oklch(38.78% 0.2184 263.86);
        }
    </style>

</head>

<body class="
    @if(!request()->routeIs('web.index')) relative top-20 text-evisablack @endif
    font-inter
    ">

    @include('web.includes.header')

    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

    @php
        $js_scripts = [
            '/js/user/jquery-3.7.1.min.js',
            '/js/user/bootstrap.bundle.min.js',
            '/js/user/swiper.min.js',
            '/js/user/appear.js',
            '/js/user/odometer.min.js',
            //'/js/user/jquery.nice-select.min.js', 
            //'/js/user/imagesloaded.pkgd.min.js', 
            '/js/user/isotope.pkgd.min.js',
            '/js/user/jquery.magnific-popup.min.js',
            '/js/user/jquery-ui.min.js',
            '/js/user/parallax-scroll.js',
            '/js/user/main.js',
            '/js/user/scripts.js'
        ]
    @endphp

    <!-- Scripts -->
    @foreach($js_scripts as $asset)
        <script src="{{ asset($asset) }}"></script>
    @endforeach

    @include('web.includes.footer')

    @stack('styles_bottom')
    @stack('scripts_bottom')

</body>

</html>