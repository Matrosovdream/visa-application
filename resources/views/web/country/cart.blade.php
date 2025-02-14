@extends('web.layouts.app')

@section('content')

    @php

        $steps = [
            'step-1' => __('Trip details'),
            'step-2' => __('Your info'),
            'step-3' => __('Passport'),
            'confirm' => __('Checkout'),
        ];

    @endphp

    <h1 class="text-3xl font-semibold ml-12 mt-6 font-inter">
        {{ $product['Model']->name }} • {{ $product['Model']->getMeta('entries_number') }} entry
    </h1>

    <div class="mx-auto mt-8  flex w-full max-w-[calc(100%-6rem)] items-center justify-between font-inter">
        <div class="absolute h-[3px] w-full max-w-[calc(100%-6rem)] bg-evisasuperlight -z-10"></div>

        @foreach($steps as $key => $step)

            <div class="flex items-center">
                <div class="flex px-4 py-2 items-center justify-center rounded-full 
                                        {{ $key == $template ? 'bg-evisablue text-white' : 'bg-evisasuperlight text-evisamedium' }}
                                        ">
                    {{ $step }}
                </div>
            </div>

        @endforeach

    </div>

    <form id="multiStepForm" class="xb-item--form contact-from apply-form" method="POST" action="{{ $action }}">
        @csrf

        <input type="hidden" name="next_page" value="{{ $next_page }}">
        <input type="hidden" name="cart_id" value="{{ $cart['fields']['id'] }}">

        <input type="hidden" name="extras_price_total" value="{{ $totals['extras_price_total'] }}" />
        <input type="hidden" name="offer_price_total" value="{{ $totals['offer_price_total'] }}" />
        <input type="hidden" name="quantity" value="{{ $cart['meta']['travellers_count'] ?? 1 }}" />

        <div class="min-h-screen flex p-6 font-inter">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-[10vw] w-full bg-white  p-6">

                <div class="border-solid max-w-3xl text-">

                    @include("web.country.partials.$template")

                    <div class="flex w-full justify-center">

                        <button onclick="window.location.href = '{{ $prev_page }}'"
                            class="mt-2 mr-2 w-[40%] bg-evisalight text-white font-medium py-2 rounded-lg hover:bg-evisasuperlight hover:text-evisamedium">
                            Previous step
                        </button>

                        <button type="submit"
                            class="mt-2 w-full bg-evisablue text-white font-medium py-2 rounded-lg hover:bg-evisabluekhover">
                            {{ __('Save and continue') }}
                        </button>
                    </div>

                </div>

                <!-- Right Column -->
                <div class="mx-auto max-w-md rounded-lg bg-white ">
                    <h2 class="mb-1 px-4 text-2xl font-semibold">Order details</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto summary-table">
                            <thead>
                                <tr class="">
                                    <th class="px-4 py-2 text-left font-semibold text-sm text-evisamedium">
                                        Product name
                                    </th>
                                    <th class="px-4 py-2 text-right font-semibold text-sm text-evisamedium">
                                        Price
                                    </th>
                                    <th class="px-4 py-2 text-right font-semibold text-sm text-evisamedium">
                                        Quantity
                                    </th>
                                    <th class="px-4 py-2 text-right font-semibold text-sm text-evisamedium">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($product['Model']->getRequiredExtras() as $extra) 

                                    <tr class="border-t">
                                        <td class="px-4 py-2 text-sm text-evisablack">
                                            {{ $extra->name }}
                                        </td>
                                        <td class="px-4 py-2 text-center text-sm text-evisablack">
                                            {{ $totals['extras_price'] }}
                                            {{ $currency }}
                                        </td>
                                        <td class="px-4 py-2 text-center text-sm text-evisablack">
                                            {{ $cart['meta']['travellers_count'] ?? 1 }}
                                        </td>
                                        <td class="px-4 py-2 text-right text-sm text-evisablack">
                                            <span data-price="{{ $totals['extras_price_total'] }}">
                                                {{ $totals['extras_price_total'] }}
                                                {{ $currency }}
                                            </span>
                                        </td>
                                    </tr>

                                @endforeach

                                <tr class="border-t">
                                    <td class="px-4 py-2 text-sm text-evisablack">
                                        {{ __('Service fees') }}
                                    </td>
                                    <td class="px-4 py-2 text-center text-sm text-evisablack">
                                        {{ $totals['offer_price'] }} {{ $currency }}
                                    </td>
                                    <td class="px-4 py-2 text-center text-sm text-evisablack">
                                        {{ $cart['meta']['travellers_count'] ?? 1 }}
                                    </td>
                                    <td class="px-4 py-2 text-right text-sm text-evisablack">
                                        <span id="offer-price-span" data-price="{{ $totals['offer_price_total'] }}">
                                            {{ $totals['offer_price_total'] }} {{ $currency }}
                                        </span>
                                    </td>
                                </tr>

                                @foreach($extras['optional'] as $extra) 

                                    <tr
                                        class="border-t optional-service service-{{ $extra->id }} {{ !isset($cart['extras'][$extra->id]) ? "hidden" : '' }}">
                                        <td class="px-4 py-2 text-sm text-evisablack">
                                            {{ $extra->name }}
                                        </td>
                                        <td class="px-4 py-2 text-center text-sm text-evisablack">
                                            {{ $extra->price }}
                                            {{ $currency }}
                                        </td>
                                        <td class="px-4 py-2 text-center text-sm text-evisablack">
                                            {{ $cart['meta']['travellers_count'] ?? 1 }}
                                        </td>
                                        <td class="px-4 py-2 text-right text-sm text-evisablack">
                                            <span data-price="{{ $extra->price * $cart['meta']['travellers_count'] }}">
                                                {{ $extra->price * $cart['meta']['travellers_count'] }}
                                                {{ $currency }}
                                            </span>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr class="  border-t border-solid border-t-1 border-evisalight">
                                    <td class="px-4 py-2  font-semibold text-evisablack" colspan="3">
                                        {{ __('Total price') }}
                                    </td>
                                    <td class="px-4 py-2 text-right  font-semibold text-evisablack">
                                        <span id="total-price-span">
                                            {{ $totals['total_price'] }} {{ $currency }}
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

            </div>
        </div>

    </form>

    </div>

    @include('web.country.partials.apply-scripts')

@endsection