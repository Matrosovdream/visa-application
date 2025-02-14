<header class="flex items-center justify-between px-6 py-4 bg-white shadow-md">

    <a href="/">
        <img src="{{ asset('user/assets/img/logo/logo.svg') }}" alt="Logo" class="h-12" />
    </a>

    <nav class="hidden md:flex space-x-6 font-medium text-lg text-gray-600">
        @foreach($menuTop as $menu)
            <a href="{{ $menu['url'] }}" class="hover:text-gray-950">
                {{ $menu['title'] }}
            </a>
        @endforeach

    </nav>

    <div class="flex items-center space-x-8">
        <div class="flex items-center space-x-4">

        @if( Auth::check() )

            <form class="relative group">
                <button type="button"
                    class="flex items-center space-x-1 font-medium text-lg text-gray-700 group-hover:text-gray-950">
                    <span>Dashboard</span>
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div
                    class="absolute z-10 left-0 mt-2 bg-white p-3 rounded-b-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">

                    @if(Auth::check())

                        @if (Auth::user()->isAdmin() || Auth::user()->isManager())
                            <a href="{{ route('dashboard.home') }}"
                                class="block py-2 text-lg text-gray-700 font-medium hover:text-blue-700">
                                {{ __('Dashboard') }}
                            </a>
                        @endif

                        <a href="{{ route('web.account.index') }}"
                            class="block py-2 text-lg text-gray-700 font-medium hover:text-blue-700">
                            {{ __('Account') }}
                        </a>
                        <a href="{{ route('web.account.orders') }}"
                            class="block py-2 text-lg text-gray-700 font-medium hover:text-blue-700">
                            {{ __('Orders') }}
                        </a>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="block py-2 text-lg text-gray-700 font-medium hover:text-blue-700">
                            {{ __('Log out') }}
                        </a>
                    @else

                        <a href="{{ route('login') }}"
                            class="block py-2 text-lg text-gray-700 font-medium hover:text-blue-700">
                            {{ __('Sign in') }}
                        </a>
                        <a href="{{ route('register') }}"
                            class="block py-2 text-lg text-gray-700 font-medium hover:text-blue-700">
                            {{ __('Sign up') }}
                        </a>

                    @endif

                </div>
            </form>
            <div class="h-5 bg-gray-400 w-0.5 rounded-full"></div>

        @endif

            <div class="relative group">
                <button type="button"
                    class="flex items-center space-x-1 font-medium text-lg text-gray-700 group-hover:text-gray-950">
                    <span>
                        {{ $activeLanguage->name }}
                    </span>
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div
                    class="absolute z-10 left-0 mt-2 bg-white p-3 rounded-b-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">

                    @foreach($languages as $language)

                        <form action="{{ route('web.language.set') }}" method="POST">
                            @csrf
                            <input type="hidden" name="lang" value="{{ $language->code }}">
                            <button type="submit" class="block py-2 text-lg text-gray-700 font-medium hover:text-blue-700">
                                {{ $language->name }}
                            </button>
                        </form>

                    @endforeach

                </div>
            </div>
            <div class="h-5 bg-gray-400 w-0.5 rounded-full"></div>

            <div class="relative group">
                <button type="button"
                    class="flex items-center space-x-1 font-medium text-lg text-gray-700 group-hover:text-gray-950">
                    <span>
                        {{ $activeCurrency->name }}
                    </span>
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div
                    class="absolute z-10 left-0 mt-2 bg-white p-3 rounded-b-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">

                    @foreach($currencies as $currency)

                        <form action="{{ route('web.currency.set') }}" method="POST">
                            @csrf
                            <input type="hidden" name="currency" value="{{ $currency->code }}">
                            <button type="submit" class="block py-2 text-lg text-gray-700 font-medium hover:text-blue-700">
                                {{ $currency->name }}
                            </button>
                        </form>

                    @endforeach

                </div>
            </div>

        </div>

        @if( !Auth::check() )
            <a 
                href="{{ route('login') }}" 
                class="px-3 py-2 text-white bg-blue-700 rounded-xl hover:bg-blue-700">
                {{ __('Sign in') }}
            </a>
        @endif

    </div>
</header>


<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>