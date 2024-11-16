<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @foreach([
            '/assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.css',
            '/assets/admin/plugins/custom/datatables/datatables.bundle.css',
            '/assets/admin/plugins/global/plugins.bundle.css',
            '/assets/admin/css/style.bundle.css',
        ] as $asset)
            <link rel="stylesheet" href="{{ asset($asset) }}">
        @endforeach

    </head>


    <body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">

        <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
        <style>
            body { 
                background-image: url({{ asset('assets/admin/media/auth/bg10.jpeg') }}); 
            } 
            [data-bs-theme="dark"] body { 
                background-image: url({{ asset('assets/admin/media/auth/bg10-dar') }}); 
            }
        </style>
        
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <div class="d-flex flex-lg-row-fluid">
                    <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                        <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" 
                        src="{{ asset('assets/admin/media/auth/agency.png') }}" alt="" />
                        <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" 
                        src="{{ asset('assets/admin/edia/auth/agency-dark.png') }}" alt="" />
                        <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Fast, Efficient and Productive</h1>
                        <div class="text-gray-600 fs-base text-center fw-semibold">In this kind of post, 
                        <a href="#" class="opacity-75-hover text-primary me-1">the blogger</a>introduces a person they’ve interviewed 
                        <br />and provides some background information about 
                        <a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a>and their 
                        <br />work following this is a transcript of the interview.</div>
                    </div>
                </div>
                <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                    <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                        <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                            <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">

                                {{ $slot }}

                            </div>
                            <div class="d-flex flex-stack">
                                <div class="me-10">
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7" data-kt-menu="true" id="kt_auth_lang_menu">
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
                                                <span class="symbol symbol-20px me-4">
                                                    <img data-kt-element="lang-flag" class="rounded-1" src="assets/media/flags/united-states.svg" alt="" />
                                                </span>
                                                <span data-kt-element="lang-name">English</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex fw-semibold text-primary fs-base gap-5">
                                    <a href="pages/team.html" target="_blank">Terms</a>
                                    <a href="pages/pricing/column.html" target="_blank">Plans</a>
                                    <a href="pages/contact.html" target="_blank">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

    </body>
</html>
