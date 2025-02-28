<h2 class="text-lg font-semibold text-gray-800 mt-6 mb-4">
    {{ __('Applicants') }}
</h2>
<ul class="list-disc pl-5 text-evisablack mb-8">
    @foreach($order->travellers as $traveller)

        <li class="mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-5">
                        {{ $traveller->name }} {{ $traveller->lastname }}
                    </h5>

                    @if(!$traveller->isCompletedForm())
                        <p>{{ __('We need you to complete the following questions in order to move forward with your') }} Egypt
                            eVisa.</p>
                    @endif

                </div>

                <div class="flex items-center justify-between">

                    <a href="{{ route('web.account.order.applicant.personal', ['order_id' => $order->id, 'applicant_id' => $traveller->id, 'category' => 'personal']) }}"
                        class="text-l mt-4 text-gray-500 group-hover:text-blue-700">

                        <span class="text-md text-grey-900 bg-orange-100 text-orange-500 px-2 py-1 mt-4 rounded-md">
                            @if(!$traveller->isCompletedForm())
                                {{ __('Complete form now') }} ➔
                            @else
                                {{ __('View details') }}
                            @endif
                        </span>

                    </a>

                </div>

            </div>
        </li>

    @endforeach
</ul>