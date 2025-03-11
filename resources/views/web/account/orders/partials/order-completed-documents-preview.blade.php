@if(count($order->certificates) > 0)

    <h2 class="text-lg font-semibold text-gray-800 mt-6 mb-1">
        {{ __('Completed Documents') }}
    </h2>
    <p class="text-gray-600 mb-4">{{ __('View all applicants completed documents') }}</p>

    <ul class="space-y-4">
        @foreach($order->certificates as $item)
            <li class="flex justify-between items-center bg-gray-100 p-4 rounded-lg shadow-sm">
                
                <div class="text-gray-800 font-medium">
                    <h5>{{ $item->file->filename }}</h5>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('file.download', $item->file->id) }}" 
                       class="text-blue-600 hover:text-blue-800 font-medium">
                        {{ __('Download') }}
                    </a>
                    <a href="{{ route('file.download', $item->file->id) }}" 
                       class="text-blue-600 hover:text-blue-800 text-lg">
                        ➔
                    </a>
                </div>

            </li>
        @endforeach 
    </ul>

@endif




@php /*
@if(count($order->certificates) > 0)
    <a href="{{ route('web.account.order.documents', $order->id) }}">
        <button class="btn btn-outline-primary">
            {{ __('View documents') }}
        </button>
    </a>
@endif
*/ @endphp
