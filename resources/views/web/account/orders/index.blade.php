@extends('web.layouts.app')

@section('content')

    <div class="min-h-screen p-6">
        <main class="mt-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">
                {{ __('My orders') }}
            </h1>
            <div class="grid grid-cols-1 space-y-6 space-x-6 md:grid-cols-2 space-y-6 space-x-6 max-w-5xl">

                @if( count($orders) > 0 )

                @foreach($orders as $order)

                    <div
                        class="group max-w-[calc(100%-24px)] bg-white border-3 border-solid border-gray-200 rounded-3xl p-4 pl-6 pr-6 hover:border-3 hover:border-blue-500">
                        <a href="{{ route('web.account.order', $order->id) }}">
                            <h2 class="text-xl font-semibold text-gray-900">
                                Order #{{ $order->id }}
                            </h2>
                        </a>
                        <p class="text-xl text-gray-900">
                            {{ $order->countryTo()->name }} tourist VISA
                        </p>
                        <div class="mt-2 flex items-center justify-between">

                            @if($order->getProgress() == 1)
                                <span class="text-md text-grey-900 bg-orange-100 text-orange-500 px-2 py-1 mt-4 rounded-md">
                                    Actions needed
                                </span>
                            @elseif($order->getProgress() == 2)
                                <p class="card-text">
                                    <span class="text-md text-green-600 bg-green-100 px-2 py-1 rounded-md mt-4">
                                        {{ __('We are preparing your order') }}
                                    </span>
                            @elseif($order->getProgress() == 3)
                                <span class="text-md text-green-600 bg-green-100 px-2 py-1 rounded-md mt-4">
                                    Completed
                                </span>
                            @endif


                            @if(!$order->isPaid())

                                <a 
                                    href="{{ route('web.account.order', $order->id) }}" 
                                    class="text-xl mt-4 text-gray-500 group-hover:text-blue-700"
                                    >
                                    {{ __('Pay order here') }}
                                </a>
                                <a 
                                    href="{{ route('web.order.show', $order->hash) }}" 
                                    class="text-xl mt-4 text-gray-500 group-hover:text-blue-700"
                                    >&#10132;</a>

                            @else

                                <a 
                                    href="{{ route('web.account.order', $order->id) }}" 
                                    class="text-xl mt-4 text-gray-500 group-hover:text-blue-700"
                                    >

                                </a>
                                <a 
                                    href="{{ route('web.account.order', $order->id) }}" 
                                    class="text-xl mt-4 text-gray-500 group-hover:text-blue-700"
                                    >&#10132;</a>

                            @endif

                            @php /*
                            <a href="{{ route('web.account.order', $order->id) }}"
                                class="text-xl mt-4 text-gray-500 group-hover:text-blue-700">
                                @if($order->getProgress() == 1)
                                    {{ __('Find out why') }}
                                @else
                                    {{ __('View details') }}
                                @endif
                                →
                            </a>
                            */ @endphp

                        </div>

                    </div>

                @endforeach

                @else

                    <div class="text-left text-gray-500">
                        {{ __('No orders found') }}
                    </div>

                @endif

            </div>
        </main>
    </div>








    <!--
                <div class="container my-4">

                    <h2 class="mb-25">{{ __('My orders') }}</h2>
                    <hr/>

                    <div class="row row-cols-1 row-cols-md-3 g-4 mt-10">

                        @foreach($orders as $order)

                            <div class="col">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <span class="card-status">{{ $order->status->name }}</span>
                                            <span class="card-progress">{{ $order->getProgress() }}/3</span>
                                        </div>
                                        <h5 class="card-title mt-3">{{ $order->getProduct()->name }}</h5>
                                        <div class="card-country mb-2">
                                            <strong>{{ $order->countryTo()->name }}</strong>
                                        </div>
                                        <p class="card-text text-muted">Order #{{ $order->id }}</p>

                                        @if( $order->getProgress() == 1 )
                                            <p class="card-text">{{ __('We need more information from you') }}</p>
                                        @elseif( $order->getProgress() == 2 )
                                            <p class="card-text">{{ __('We are preparing your order') }}</p>
                                        @elseif( $order->getProgress() == 3 )
                                            <p class="card-text">{{ __('Your order is completed') }}</p>
                                        @endif

                                    </div>
                                    <div class="card-footer bg-white mb-10 mt-10 border-0 d-flex justify-content-between align-items-center">

                                        @if( !$order->isPaid() ) 

                                            <a href="{{ route('web.account.order', $order->id) }}" class="text-danger">
                                                {{ __('Pay order here') }}
                                            </a>
                                            <a href="{{ route('web.order.show', $order->hash) }}" class="btn-arrow">&#10132;</a>

                                        @else

                                            <a href="{{ route('web.account.order', $order->id) }}" class="text-decoration-none">
                                                @if( $order->getProgress() == 1 )
                                                    {{ __('Find out why') }}
                                                @else
                                                    {{ __('View details') }}
                                                @endif
                                            </a>
                                            <a href="{{ route('web.account.order', $order->id) }}" class="btn-arrow">&#10132;</a>

                                        @endif

                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>

                <style>
                    .card-body {
                        background-color: rgb(248 249 249);
                    }
                    .card-status {
                        background-color: #d1ecf1;
                        color: #0c5460;
                        border-radius: 10px;
                        padding: 4px 8px 2px 8px;
                        font-size: 0.8rem;
                        font-weight: bold;
                    }

                    .card-progress {
                        background-color: #e9ecef;
                        border-radius: 50%;
                        padding: 5px;
                        font-size: 0.8rem;
                        width: 35px;
                        height: 35px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }

                    .card-country img {
                        width: 20px;
                        margin-right: 5px;
                    }

                    .btn-arrow {
                        background: linear-gradient(90deg, #00d7b0, #00e65b);
                        color: white;
                        border-radius: 50%;
                        width: 35px;
                        height: 35px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 1.2rem;
                        border: none;
                    }
                    .card-text {
                        font-size: 15px;
                    }
                </style>
                -->

@endsection