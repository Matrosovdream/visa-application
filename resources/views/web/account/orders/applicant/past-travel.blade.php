@extends('web.layouts.app')

@section('content')

    <div class="flex h-screen p-6">
        <!-- Sidebar -->
        <aside class="w-1/4 p-6 ml-6 bg-white hidden md:block">

            @include('web.account.orders.partials.backlink', ['url' => route('web.account.order', $order->id)])

            <h2 class="text-3xl font-semibold mb-6">
                {{ $order->getProduct()->name }} - {{ __('Past travel') }}
            </h2>

            <div class="space-y-6 orders-user-sidebar">
                @include('web.account.orders.partials.sidebar')
            </div>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 max-w-5xl">
            <div class="bg-white border-2 border-solid border-evisasuperlight rounded-3xl p-8">

                <h1 class="text-2xl font-medium mb-6">
                    {{ __('Past travel') }}
                </h1>

                <form method="POST"
                    action="{{ route('web.account.order.applicant.fields.update', ['order_id' => $order->id, 'applicant_id' => $applicant->id]) }}"
                    class="grid grid-cols-2 gap-6">
                    @csrf

                    <input type="hidden" name="next_page" value="{{ $next_page ?? '' }}">

                    @include(
                        'web.partials.fields-loop',
                        [
                            'values' => $fieldValues,
                            'fields' => $formFields,
                            'entity' => 'traveller'
                        ]
                    )

                    <div class="col-span-2">
                        <button type="submit"
                            class="mt-2 bg-evisablue text-white font-medium px-4 py-2 rounded-lg hover:bg-evisabluekhover"
                            id="next-1">
                            {{ __('Save and continue') }}
                        </button>
                    </div>

                </form>

            </div>
        </main>
    </div>




    <script>

        $(document).ready(function () {

            $(document).ready(function () {
                $('#field-past_travel_country-0').on('change.select2', function () {

                    if ($(this).val() == 'yes') {
                        $('.field-block-past_travel_date').show();
                        $('.field-block-past_travel_date select').select2();

                        $('.field-block-past_travel_departure').show();
                        $('.field-block-past_travel_departure select').select2();

                        $('.field-block-past_travel_cities').show();
                    } else {
                        $('.field-block-past_travel_date select').select2('destroy');
                        $('.field-block-past_travel_date').hide();

                        $('.field-block-past_travel_departure select').select2('destroy');
                        $('.field-block-past_travel_departure').hide();

                        $('.field-block-past_travel_cities').hide();
                    }

                });

                // Trigger the change event on page load
                $('#field-past_travel_country-0').trigger('change.select2');
            });

        });



    </script>


    @if($fields['past_travel_country']['value'] == 'yes')
        <style>
            .field-block-past_travel_date,
            .field-block-past_travel_departure,
            .field-block-past_travel_cities {
                display: block;
            }
        </style>
    @else 
        <style>
            .field-block-past_travel_date,
            .field-block-past_travel_departure,
            .field-block-past_travel_cities {
                display: none;
            }
        </style>
    @endif

@endsection