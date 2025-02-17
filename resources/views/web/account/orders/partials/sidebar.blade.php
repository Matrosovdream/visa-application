<div>
    <h3 class="font-medium text-evisamedium mb-2">
        {{ __('Trip Details') }}
    </h3>
    <ul class="space-y-2 ml-8">
        <li>
            <a href="{{ route('web.account.order.trip', $order->id) }}"
                class="
                @if(request()->routeIs('web.account.order.trip'))
                    active 
                @endif
                
                flex max-w-50 items-top space-x-4 text-evisablack px-2 py-1 rounded-lg hover:bg-evisasuperlight">

                <img src="{{ asset('/user/assets/img/icon/book.svg') }}" alt="" class="w-4 h-5 mr-2">
                {{ __('General Information') }}
            </a>
        </li>
    </ul>
</div>

@foreach($order->travellers as $key => $traveller)

    <div>
        <div class="bg-evisasuperlight h-[2px] mb-4"></div>

        <h3 class="font-medium text-evisamedium mb-2">
            {{ $traveller->full_name }}
        </h3>

        <ul class="space-y-2 ml-8">

            @foreach($travellerFieldCategories as $code => $data)

                <li>
                    <a href="{{ route( $data['route'], ['order_id' => $order->id, 'applicant_id' => $traveller->id, 'category' => $code]) }}"
                        class="@if(request()->routeIs($data['route'])) active @endif flex max-w-50 items-top space-x-4 text-evisablack px-2 py-1 rounded-lg hover:bg-evisasuperlight">

                        <svg class="w-4 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 19.121L3 12l2.121-7.121L10 10l7.121-5L21 12l-2.121 7.121L14 14l-7.121 5z" />
                        </svg>

                        {{ $data['title'] }}
                    </a>
                </li>

                @if($code == 'past_travel')

                    <li>
                        <a href="{{ route( 'web.account.order.applicant.documents', ['order_id' => $order->id, 'applicant_id' => $traveller->id] )  }}"
                            class="@if(request()->routeIs('web.account.order.applicant.documents')) active @endif flex max-w-50 items-top space-x-4 text-evisablack px-2 py-1 rounded-lg hover:bg-evisasuperlight">

                            <svg class="w-4 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 19.121L3 12l2.121-7.121L10 10l7.121-5L21 12l-2.121 7.121L14 14l-7.121 5z" />
                            </svg>

                            {{ __('Documents') }}
                        </a>
                    </li>

                @endif

            @endforeach

    </div>

@endforeach