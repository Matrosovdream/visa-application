<h2 class="text-lg font-semibold text-evisablack mb-4">
    {{ __('Status') }}
</h2>

@if(!$order->isCompletedForm())
    <div class="flex items-center space-x-4 mb-4">
        <span class="text-md font-medium text-evisablack bg-evisapeach px-4 py-2 rounded-2xl">
            {{ __('Actions needed') }}
        </span>
    </div>
    <p class="text-evisablack mb-4">
        {{ __('We need more information from you to start processing documents') }}
    </p>

    <a href="{{ route('web.account.order.trip', $order->id) }}">
        <button 
            class="mb-8 inline-block text-evisablue border-solid border-3 font-medium border-evisablue rounded-xl px-4 py-2 hover:bg-evisablue hover:border-evisablue hover:text-white">
            {{ __('Complete form now') }}
        </button>
    </a>

@else

    <div class="flex items-center space-x-4 mb-4">
        <span class="text-md font-medium text-green-600 bg-green-100 px-4 py-2 rounded-2xl">
            {{ __('Form is completed') }}
        </span>
    </div>

@endif



@php /*
<div class="col @if($order->getProgress() != 1) non-active-status-block @else active-status-block @endif">
    <div class="card shadow-sm h-100">
        <div class="card-body">

            @if(!$order->isCompletedForm())
                <h5 class="card-title card-title-small mt-3 alert alert-danger text-center">
                    {{ __('Actions needed') }}
                </h5>
            @else
                <h5 class="card-title card-title-small mt-3 alert alert-success text-center">
                    {{ __('Form is completed') }}
                </h5>
            @endif

            <p>{{ $order->createAt }}</p>

            @if(!$order->isCompletedForm())
                <p class="card-text">{{ __('We need more information from you') }}</p>
            @else
                <p class="card-text">{{ __('We are preparing your order') }}</p>
            @endif

        </div>
        <div class="card-footer bg-white mb-10 mt-10 border-0 d-flex justify-content-between align-items-center">
            <a href="{{ route('web.account.order.trip', $order->id) }}" class="text-decoration-none">
                @if($order->getProgress() == 1)
                    {{ __('Complete form now') }}
                @else
                    {{ __('View details') }}
                @endif
            </a>
            <a href="{{ route('web.account.order.trip', $order->id) }}" class="btn-arrow">➔</a>
        </div>
    </div>
</div>

<div class="col @if($order->getProgress() != 2) non-active-status-block @endif">
    <div class="card shadow-sm h-100">
        <div class="card-body">
            <h5 class="card-title mt-3 text-center mb-30">
                {{ __('Waiting on Government') }}
            </h5>
            <p>{{ $order->createAt }}</p>
            <p class="card-text">
                {{ __('We are currently waiting for the Government to get back to us on the result of your application') }}
            </p>
        </div>
    </div>
</div>

<div class="col @if($order->getProgress() == 2 || $order->getProgress() == 1) non-active-status-block @endif">
    <div class="card shadow-sm h-100">
        <div class="card-body">
            <h5 class="card-title mt-3 text-center mb-30">
                {{ __('Order closed') }}
            </h5>
            <p>{{ $order->createAt }}</p>
            <p class="card-text">
                {{ __('Congratulations! Your document is ready for download!') }}
            </p>
        </div>
    </div>
</div>
*/ @endphp