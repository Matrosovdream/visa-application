<header
  class="fixed top-0 left-0 w-full z-50 flex items-center justify-between px-6 py-4 bg-white shadow-md font-inter">

  <a href="/">
    <img src="{{ asset('user/assets/img/logo/evisa_logo.png') }}" alt="Logo" class="h-12" />
  </a>

  <nav class="hidden md:flex space-x-6 font-medium text-lg">
      @foreach($menuTop as $menu)
        <a href="{{ $menu['url'] }}" class="hover:text-evisablackhover">
          {{ $menu['title'] }}
        </a>
      @endforeach
  </nav>

  <div class="flex items-center space-x-8">
    <div class="hidden md:flex items-center space-x-4">

      <div class="relative group">
        <button type="button" class="flex items-center space-x-1 font-medium text-lg group-hover:">
          <span class="hover:text-evisablackhover">
            {{ $activeLanguage->name }}
          </span>
          <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div
          class="absolute z-10 left-0 mt-2 bg-white p-3 rounded-b-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
          
          @foreach($languages as $language)
            <form action="{{ route('web.language.set') }}" method="POST">
                @csrf
                <input type="hidden" name="lang" value="{{ $language->code }}">
                <button type="submit" class="block py-2 text-lg font-medium hover:text-evisablue">
                    {{ $language->name }}
                </button>
            </form>
          @endforeach
          
        </div>
      </div>

      <div class="h-5 bg-evisalight w-0.5 rounded-full"></div>

      <div class="relative group">

        <button type="button" class="flex items-center space-x-1 text-lg font-medium group-hover:">
          <span class="hover:text-evisablackhover">
            {{ $activeCurrency->name }}
          </span>
          <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <div
          class="absolute z-10 left-0 mt-2 bg-white p-3 rounded-b-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
            
            @foreach($currencies as $currency)

              <form action="{{ route('web.currency.set') }}" method="POST">
                  @csrf
                  <input type="hidden" name="currency" value="{{ $currency->code }}">
                  <button type="submit" class="block py-2 text-lg hover:text-evisablue font-medium">
                      {{ $currency->name }}
                  </button>
              </form>

            @endforeach

        </div>
        
      </div>

    </div>

    <div class="flex items-center justify-between">

      @if(!Auth::check())

      <a href="{{ route('login') }}" class="px-3 py-2 text-white bg-blue-700 rounded-xl hover:bg-blue-700">
      {{ __('Sign in') }}
      </a>

    @else

      <button id="right-button" type="button"
      class="space-x-[4px] w-auto inline-flex items-center px-3 py-2 whitespace-nowrap text-base md:text-lg text-evisablue font-medium bg-white rounded-xl outline-solid outline-3 outline-evisablue">
      <svg width="16" height="16" viewBox="0 0 22 25" fill="currentColor" stroke="currentColor"
        xmlns="http://www.w3.org/2000/svg">
        <path
        d="M10.7934 10.8313C13.5916 10.8313 15.8603 8.63813 15.8603 5.91563C15.8603 3.19313 13.5916 1 10.7934 1C7.99531 1 5.72656 3.19313 5.72656 5.91563C5.72656 8.63813 7.99531 10.8313 10.7934 10.8313ZM10.7934 2.73938C12.6463 2.73938 14.1588 4.17625 14.1588 5.95344C14.1588 7.73063 12.6463 9.1675 10.7934 9.1675C8.94062 9.1675 7.42813 7.73063 7.42813 5.95344C7.42813 4.17625 8.94062 2.73938 10.7934 2.73938Z" />
        <path
        d="M13.2513 12.5327H8.33563C4.28969 12.5327 1 15.8602 1 19.9062V23.0446C1 23.4983 1.37812 23.9143 1.86969 23.9143C2.36125 23.9143 2.73938 23.5362 2.73938 23.0446V19.9062C2.73938 16.8055 5.27281 14.2343 8.41125 14.2343H13.2891C16.3897 14.2343 18.9609 16.7677 18.9609 19.9062V23.0446C18.9609 23.4983 19.3391 23.9143 19.8306 23.9143C20.3222 23.9143 20.7003 23.5362 20.7003 23.0446V19.9062C20.5869 15.8602 17.2972 12.5327 13.2513 12.5327Z" />
      </svg>

      <span>
        {{ Auth::user()->name }}
      </span>

      </button>

      <div id="mobile-rightmenu"
        class="fixed top-22 right-6 rounded-2xl right-[-100%] w-[142px] h-auto text-lg bg-white outline- outline- outline-evisablue z-50">
      <ul class="flex flex-col text-base font-medium rounded-2xl py-2">
        <li>

          @if(Auth::check())

            @if (Auth::user()->isAdmin() || Auth::user()->isManager())
              <a 
                href="{{ route('dashboard.home') }}"
                class="block py-2 pl-7 text-evisablack rounded hover:bg-evisasuperlight">
                {{ __('Dashboard') }}
              </a>
            @endif

            <a href="{{ route('web.account.index') }}"
              class="block py-2 pl-7 text-evisablack rounded hover:bg-evisasuperlight">
              {{ __('Account') }}
            </a>
            <a href="{{ route('web.account.orders') }}"
              class="block py-2 pl-7 text-evisablack rounded hover:bg-evisasuperlight">
              {{ __('Orders') }}
            </a>
            <a href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
              class="block py-2 pl-7 text-evisablack rounded hover:bg-evisasuperlight">
              {{ __('Log out') }}
            </a>

          @else

            @php /*
            <a href="{{ route('login') }}" class="block py-2 pl-7 text-evisablack rounded hover:bg-evisasuperlight">
              {{ __('Sign in') }}
            </a>
            <a href="{{ route('register') }}" class="block py-2 pl-7 text-evisablack rounded hover:bg-evisasuperlight">
              {{ __('Sign up') }}
            </a>
            */ @endphp

          @endif

        </li>
      </ul>
      </div>

    @endif

    </div>
  </div>

  <button id="menu-button" type="button"
    class="order-first inline-flex items-center p-2 ml-3 text-sm text-evisablack md:hidden">
    <span class="sr-only">Open main menu</span>

    <svg id="burger-icon" class="w-6 h-6 transition-all duration-300" fill="currentColor" viewBox="0 0 20 20"
      xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd"
        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
        clip-rule="evenodd"></path>
    </svg>

    <svg id="close-icon" class="w-6 h-6 hidden transition-all duration-300" fill="currentColor" viewBox="0 0 20 20"
      xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd"
        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
        clip-rule="evenodd"></path>
    </svg>
  </button>

  <div id="mobile-menu"
    class="fixed top-20 rounded-br-2xl left-[-100%] w-auto h-auto bg-white shadow-lg z-50 transition-all duration-300 ease-in-out md:hidden">
    <ul class="flex flex-col text-base font-medium p-4">
      <li>
        @foreach($menuTop as $menu)
      <a href="{{ $menu['url'] }}" class="block py-2 pr-20 pl-7 mb-2 text-evisablack rounded">
        {{ $menu['title'] }}
      </a>
    @endforeach
      </li>
    </ul>
  </div>

</header>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>