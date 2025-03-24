@extends('web.layouts.app')

@section('content')

    <div class="flex h-screen p-6">
        <!-- Sidebar -->
        <aside class="w-1/4 p-6 ml-6 bg-white hidden md:block">

            @include('web.account.orders.partials.backlink', ['url' => route('web.account.order', $order->id)])

            <h2 class="text-3xl font-semibold mb-6">
                {{ $order->getProduct()->name }} - {{ __('Trip Details') }}
            </h2>

            <div class="space-y-6 orders-user-sidebar">
                @include('web.account.orders.partials.sidebar')
            </div>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 max-w-5xl">
            <div class="bg-white border-2 border-solid border-evisasuperlight rounded-3xl p-8">

                <h1 class="text-2xl font-medium mb-6">
                    {{ __('Declarations') }}
                </h1>

                <form method="POST"
                    action="{{ route('web.account.order.applicant.fields.update', ['order_id' => $order->id, 'applicant_id' => $applicant->id]) }}"
                    class="grid grid-cols-2 gap-6 fields-loop-form">
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
                        <button 
                            type="submit" 
                            class="mt-2 bg-evisablue text-white font-medium px-4 py-2 rounded-lg hover:bg-evisabluekhover"
                            id="next-1"
                            >
                            {{ __('Save and continue') }}
                        </button>
                    </div>

                </form>

            </div>
        </main>
    </div>


    @include('web.account.orders.partials.form-script')


    <script>

        $(document).ready(function () {

            $('#field-is_previous_country_deport-0').on('change.select2', function () {

                var blocks = [
                    'previous_country_deport_country',
                    'previous_country_deport_date',
                    'previous_country_deport_details'
                ];

                if ($(this).val() == 'yes') {
                    blocks.forEach(function (block) {
                        $('.field-block-' + block).show();
                        $('.field-block-' + block + ' select').select2({
                            dropdownCssClass: 'select2-dropdown',
                            containerCssClass: 'select2-container',
                            minimumResultsForSearch: 10,
                            templateResult: formatCountry,
                            templateSelection: formatCountry,
                            width: '100%'
                        });
                    });
                } else {
                    blocks.forEach(function (block) {
                        $('.field-block-' + block).hide();
                    });
                }

            });

            // Trigger the change event on page load
            $('#field-is_previous_country_deport-0').trigger('change.select2');

        });



    </script>

    @php 

        //dd($fields);
    @endphp

    @if($fields['is_previous_country_deport']['value'] == 'yes')
        <style>
            .field-block-previous_country_deport_country,
            .field-block-previous_country_deport_date,
            .field-block-previous_country_deport_details {
                display: block;
            }
        </style>
    @else
        <style>
            .field-block-previous_country_deport_country,
            .field-block-previous_country_deport_date,
            .field-block-previous_country_deport_details {
                display: none;
            }
        </style>
    @endif



@endsection