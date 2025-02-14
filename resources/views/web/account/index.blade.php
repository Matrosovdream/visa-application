@extends('web.layouts.app')

@section('content')

    @php
    $menu = [
        'orders' => [
            'title' => 'My Orders',
            'description' => 'View your orders and travel documents',
            'route' => route('web.account.orders'),
            'icon' => 'fa fa-shopping-cart',
        ],
        'settings' => [
            'title' => 'Security & Privacy',
            'description' => 'Update your password and account details',
            'route' => route('web.account.settings'),
            'icon' => 'fa fa-lock',
        ],
        
    ];
    @endphp

    <div class="min-h-screen p-6">
        <main class="mt-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">
                {{ __('My account') }}
            </h1>
            <div class="grid grid-cols-1 space-y-6 space-x-6 md:grid-cols-2 space-y-6 space-x-6 max-w-5xl">

                @foreach( $menu as $key=>$item ) 

                    <div
                        class="group max-w-[calc(100%-24px)] bg-white border-3 border-solid border-gray-200 rounded-3xl p-4 pl-6 pr-6 hover:border-3 hover:border-blue-500">

                        <h2 class="text-xl font-semibold text-gray-900">
                            {{ __( $item['title'] ) }}
                        </h2>

                        <p class="text-l text-gray-900">
                            {{ __( $item['description'] ) }}
                        </p>

                        <div class="mt-2 flex items-center justify-between">
                            <a href="{{ $item['route'] }}"
                                class="text-l mt-4 text-gray-500 group-hover:text-blue-700">

                                <span
                                    class="text-md text-green-600 bg-green-100 px-2 py-1 rounded-md mt-4">
                                    View →
                                </span>
                            </a>
                        </div>
                    </div>
                
                @endforeach

            </div>
        </main>
    </div>

@endsection