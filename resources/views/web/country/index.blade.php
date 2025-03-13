@extends('web.layouts.app')

@section('content')

    <div class="h-auto flex font-inter">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-[10vw] w-full bg-gray-50 rounded-lg">

            <form method="GET" action="{{ route('web.country.apply', $country->slug) }}">

                <div class="m-6 md:ml-12 mt-6 border-solid max-w-3xl text-sm">
                    <h1 class="text-2xl md:text-3xl font-semibold mb-8">
                        {{ __('Apply now for your') }} {{ $country->name }} eVisa
                    </h1>

                    @if(isset($countryFrom))

                        @if(isset($products) && count($products) > 0)

                            <div class="mb-8 p-4 bg-evisapeach text-evisamedium rounded-2xl">
                                <h2 class="font-medium mb-1">
                                    {{ __('Visa required') }}
                                </h2>
                                <p class>
                                    {{ __('You need a visa to travel to') }} {{ $country->name }}
                                    {{ __('if you have a passport from') }}
                                    {{ $countryFrom->name }}.
                                </p>
                            </div>

                        @else

                            <div class="mb-8 p-4 bg-evisapeach text-evisamedium rounded-2xl">
                                <h2 class="font-medium mb-1">
                                    {{ __('Visa required') }}
                                </h2>
                                <p class>
                                    {{ __("But we currently don't offer this service.") }}
                                </p>
                            </div>

                        @endif

                    @else
                        {{ __("Choose a nationality to see if you need a visa to travel to") }} {{ $country->name }}.
                    @endif

                    @if($direction->visa_req == 1 && isset($products) && count($products) > 0)

                        <div class="mb-4">
                            <label for="nationality" class="block text-evisamedium">
                                {{ __("What is your nationality?") }}
                            </label>
                            <select name="nationality" id="nationality"
                                class="select2 mt-1 block w-full px-3 py-2 border-solid border-2 border-evisasuperlight hover:border-evisalightblue rounded-lg">

                                @foreach($countries as $country)
                                    <option 
                                        value="{{ $country->slug }}" 
                                        data-slug="{{ $country->slug }}" 
                                        @if(isset($countryFrom) && $country->slug == $countryFrom->slug) selected @endif
                                        data-flag="{{ App\Helpers\countryHelper::getFlagUrl($country->code) }}"
                                        >
                                        {{ $country->name }} - {{ $country->code }}
                                    </option>
                                @endforeach

                            </select>
                            <small class="form-text text-muted">
                                {{ __("Ensure you select the nationality of the passport you'll betraveling with.") }}
                            </small>
                        </div>

                        <!-- Applying For -->
                        @if(isset($products) && count($products) > 0)

                            <div class="mb-4">
                                <label for="visa-type" class="block text-evisamedium">
                                    {{ __("Applying for") }}
                                </label>
                                <select 
                                    id="visaType" 
                                    aria-label="Visa Type" 
                                    name="product_id"
                                    class="select2 mt-1 block w-full px-3 py-2 border-solid border-2 border-evisasuperlight hover:border-evisalightblue rounded-lg">
                                    
                                    @foreach($products as $product)
                                        <option 
                                            value="{{ $product->id }}"
                                            >
                                            {{ $product->name }}
                                        </option>
                                    @endforeach

                                </select>
                                <small class="form-text text-muted">
                                    {{ __("Choose your Visa product") }}
                                </small>
                            </div>

                            <button type="submit"
                                class="mt-2 w-full bg-evisablue text-white font-medium py-2 rounded-xl hover:bg-evisabluekhover">
                                {{ __('Start application') }}
                            </button>

                        @endif

                    @endif

                </div>

            </form>

            @if($direction->visa_req == 1 && isset($products) && count($products) > 0)

                @php $key = 0; @endphp
                @foreach($products as $product)

                    <div class="product-card md:block mt-6 border-solid border-3 border-evisablue rounded-2xl p-6 max-w-sm h-55 text-evisablack"
                        id="product-card-{{ $product->id }}" @if($key != 0) style="display: none" @endif>

                        <h2 class="text-xl font-semibold mb-8">
                            {{ $product->name }}
                        </h2>
                        <div class="space-y-2">
                            <p class="flex justify-between">
                                <span class="">{{ __('Valid for') }}:</span>
                                <span class="font-semibold">
                                    {{ $product->getMeta('valid_for') }} {{ __('days') }}
                                </span>
                            </p>
                            <p class="flex justify-between">
                                <span class="">
                                    {{ __('Number of entries') }}:
                                </span>
                                <span class="font-semibold">
                                    {{ $product->getMeta('entries_number') }}
                                </span>
                            </p>
                            <p class="flex justify-between">
                                <span class="">
                                    {{ __('Max stay') }}:
                                </span>
                                <span class="font-semibold">
                                    {{ $product->getMeta('max_stay') }} {{ __('days in total') }}
                                </span>
                            </p>
                        </div>
                    </div>

                    @php $key++; @endphp
                @endforeach

            @endif

        </div>
    </div>
    <div class="h-60 bg-gray-50"></div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

        // Redirect after changin nationality
        jQuery(document).ready(function () {
            jQuery('#nationality').change(function () {
                var selectedNationalitySlug = jQuery(this).find(':selected').data('slug');
                window.location.href = window.location.pathname + "?nationality=" + selectedNationalitySlug;
            });
        });

        // Show product details
        jQuery(document).ready(function () {
            jQuery('#visaType').change(function () {
                var selectedProductId = jQuery(this).find(':selected').val();
                jQuery('.product-card').hide();
                jQuery('#product-card-' + selectedProductId).show();
            });
        });

    </script>



@endsection