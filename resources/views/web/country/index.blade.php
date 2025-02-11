@extends('web.layouts.app')

@section('content')

<div class="min-h-screen flex p-6 font-inter">

    <form class="grid grid-cols-1 md:grid-cols-2 gap-[10vw] w-full bg-white rounded-lg p-6" method="GET"
        action="{{ route('web.country.apply', $country->slug) }}">

        <!-- Left Column -->
        <div class="border-solid max-w-3xl text-">
            <h1 class="text-3xl font-semibold mb-8">
                {{ __('Apply now for your') }} {{ $country->name }} eVisa
            </h1>

            @if(isset($countryFrom))
                @if($direction->visa_req == 1)

                    <div class="mb-8 p-4 bg-evisapeach text-evisamedium rounded-2xl">
                        <h2 class="font-semibold mb-1">
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
                        <h2 class="font-semibold mb-1">
                            {{ __('No visa required') }}
                        </h2>
                        <p class>
                            {{ __("You don't need a visa to travel to") }} {{ $country->name }}
                            {{ __("if you have a passport from") }}
                            {{ $countryFrom->name }}.
                        </p>
                    </div>

                @endif
            @else
                {{ __("Choose a nationality to see if you need a visa to travel to") }} {{ $country->name }}.
            @endif



            <div class="mb-4">
                <label for="nationality" class="block text-evisamedium">
                    {{ __("What is your nationality?") }}
                </label>

                <select
                    class="select2 mt-1 block w-full px-3 py-2 border-solid border-2 border-evisalight hover:border-evisalightblue rounded-lg"
                    name="nationality" id="nationality" aria-label="Nationality">
                    @foreach($countries as $country)
                        <option value="{{ $country->slug }}" data-slug="{{ $country->slug }}" @if(isset($countryFrom) && $country->slug == $countryFrom->slug) selected @endif>
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
                    <label for="nationality" class="block text-evisamedium">
                        {{ __("Applying for") }}
                    </label>

                    <select
                        class="select2 mt-1 block w-full px-3 py-2 border-solid border-2 border-evisalight hover:border-evisalightblue rounded-lg"
                        id="visaType" aria-label="Visa Type" name="product_id">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">
                        {{ __("Choose your Visa product") }}
                    </small>

                </div>

            @endif

            <button type="submit"
                class="mt-2 w-full bg-evisablue text-white font-medium py-2 rounded-xl hover:bg-evisabluekhover">
                {{ __('Apply for eVisa') }}
            </button>
        </div>

        @if($direction->visa_req == 1)

            @if(isset($products) && count($products) > 0)

                @php $key = 0; @endphp
                @foreach($products as $product)

                    <div class="product-card border-solid border-3 border-evisablue rounded-2xl p-6 max-w-sm h-50"
                        id="product-card-{{ $product->id }}" @if($key != 0) style="display: none" @endif>
                        <h2 class="text-2xl font-medium mb-4">{{ $product->name }}</h2>
                        <div class="space-y-2">
                            <p class="flex justify-between">
                                <span class="">{{ __('Valid for') }}:</span>
                                <span>{{ $product->getMeta('valid_for') }} days</span>
                            </p>
                            <p class="flex justify-between">
                                <span class="">{{ __('Number of entries') }}:</span>
                                <span>{{ $product->getMeta('entries_number') }}</span>
                            </p>
                            <p class="flex justify-between">
                                <span class="">{{ __('Max stay') }}:</span>
                                <span>{{ $product->getMeta('max_stay') }} {{ __('days in total') }}</span>
                            </p>
                        </div>
                    </div>

                    @php $key++; @endphp

                @endforeach

            @endif

        @endif


    </form>

</div>
</div>






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