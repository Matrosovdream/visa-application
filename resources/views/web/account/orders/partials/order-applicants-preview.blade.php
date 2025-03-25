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
                        <p class="mb-4">
                            {{ __('We need you to complete the following questions in order to move forward with your Visa') }}
                        </p>
                    @endif

                </div>

                <div class="flex items-center justify-between">

                    <a href="{{ route('web.account.order.applicant.personal', ['order_id' => $order->id, 'applicant_id' => $traveller->id, 'category' => 'personal']) }}"
                        class="text-l text-gray-500 group-hover:text-blue-700">

                        @if(!$traveller->isCompletedForm())
                            <span class="text-md text-grey-900 bg-orange-100 text-orange-500 px-2 py-1 rounded-md">
                                {{ __('Complete form now') }} ➔
                            </span>
                        @else
                            <span class="text-md text-green-600 bg-green-100 px-2 py-1 rounded-md">
                            {{ __('View details') }} ➔
                            </span>
                        @endif

                    </a>

                </div>

            </div>
        </li>

    @endforeach
</ul>