@extends('web.layouts.app')

@section('content')


    <div class="flex h-screen p-6">
        <!-- Sidebar -->
        <aside class="w-1/4 p-6 ml-6 bg-white">
            <a href="/account/" class="text-blue-600 mb-4 inline-block hover:underline">
                &larr; {{ __('Back to main menu') }}
            </a>
            <h2 class="text-3xl font-semibold mb-6">
                {{ __('My account') }}
            </h2>
            <div class="space-y-6 orders-user-sidebar">
                <ul class="space-y-2 ml-8 ">
                    <li>
                        <a href="#"
                            class="active flex max-w-50 items-top space-x-4 text-evisablack px-2 py-1 rounded-lg hover:bg-evisasuperlight">
                            <svg class="w-4 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 19.121L3 12l2.121-7.121L10 10l7.121-5L21 12l-2.121 7.121L14 14l-7.121 5z" />
                            </svg>
                            {{ __('Security & Privacy') }}
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 max-w-5xl">
            <div class="bg-white border-2 border-solid border-evisasuperlight rounded-3xl p-8">
                <h1 class="text-2xl font-medium mb-6">
                    {{ __('Security & Privacy') }}
                </h1>

                @if ($errors->any())
                    <div class="alert alert-danger mb-2" role="danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success" role="success">
                        {{ session('success') }}
                    </div>
                @endif

                <form class="grid grid-cols-2 gap-6" method="POST" action="{{ route('web.account.settings') }}">
                    @csrf

                    <div>
                        <label class="block text-evisamedium mb-1">{{ __('Current password') }}</label>
                        <input type="password" name="current_password"
                            class="block w-full px-3 py-2 border-solid border-2 border-evisasuperlight hover:border-evisalightblue focus:outline-0 focus:border-evisalightblue rounded-lg"
                            value="">
                    </div>

                    <div>
                        <label class="block text-evisamedium mb-1">{{ __('New password') }}</label>
                        <input type="password" name="new_password"
                            class="block w-full px-3 py-2 border-solid border-2 border-evisasuperlight hover:border-evisalightblue focus:outline-0 focus:border-evisalightblue rounded-lg"
                            value="">
                    </div>

                    <div>
                        <label class="block text-evisamedium mb-1">{{ __('Confirm new password') }}</label>
                        <input type="password" name="new_password_confirmation"
                            class="block w-full px-3 py-2 border-solid border-2 border-evisasuperlight hover:border-evisalightblue focus:outline-0 focus:border-evisalightblue rounded-lg"
                            value="">
                    </div>

                    <div class="col-span-2">
                        <button type="submit"
                            class="mt-2 bg-evisablue text-white font-medium px-4 py-2 rounded-lg hover:bg-evisabluekhover">
                            {{ __('Update Password') }}
                        </button>
                    </div>


                </form>

            </div>
        </main>
    </div>





@endsection