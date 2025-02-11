<!-- Left Column -->
<div>
    <div class="border-solid max-w-3xl text-">
        <div class="mb-4">
            <div class="flex w-full items-center justify-between">
                <h2 class="mb-4 text-2xl font-semibold">Select your package</h2>
            </div>

            <form
                class="group mb-4 bg-white border-2 border-solid border-evisasuperlight rounded-xl p-4 pl-6 pr-6 hover:border-evisablue">
                <h2 class="text- font-semibold text-evisablack py-1">
                    Standart
                </h2>
                <p class="text- text-evisablack py-1">
                    Standart offer for 2 days
                </p>
                <p class="text- text-evisablack py-1">30$</p>
            </form>

            <form
                class="group mb-4 bg-white border-2 border-solid border-evisasuperlight rounded-xl p-4 pl-6 pr-6 hover:border-evisablue">
                <h2 class="text- font-semibold text-evisablack py-1">
                    Standart
                </h2>
                <p class="text- text-evisablack py-1">
                    Standart offer for 2 days
                </p>
                <p class="text- text-evisablack py-1">30$</p>
            </form>

            <form
                class="group mb-4 bg-white border-2 border-solid border-evisasuperlight rounded-xl p-4 pl-6 pr-6 hover:border-evisablue">
                <h2 class="text- font-semibold text-evisablack py-1">
                    Standart
                </h2>
                <p class="text- text-evisablack py-1">
                    Standart offer for 2 days
                </p>
                <p class="text- text-evisablack py-1">30$</p>
            </form>
            <h2 class="mb-4 text-2xl font-semibold text-evisablack">Extra services</h2>
            <form
                class="group mb-4 bg-white border-2 border-solid border-evisasuperlight rounded-xl p-4 pl-6 pr-6 hover:border-evisablue">
                <h2 class="text- font-semibold text-evisablack py-1">
                    Denial protection
                </h2>

                <p class="text- text-evisablack py-1">25$</p>
            </form>

        </div>
    </div>
</div>


<!--
<ul class="list-group apply-offer-list">
    @foreach($product['Model']->offers as $offer)
        <li class="">
            <div class="form-check  @if($loop->first) active @endif">

                <input class="form-check-input" type="radio" name="offer_id" id="offer-{{ $offer->id }}"
                    value="{{ $offer->id }}" data-price="{{ $offer->price }}" @if($loop->first) checked @endif>

                <label class="form-check label" for="offer-{{ $offer->id }}">
                    <h5>{{ $offer->name }}</h5>
                    <p>{{ $offer->description }}</p>
                    <p>{{ $offer->price }} {{ $currency }}</p>
                </label>
            </div>
        </li>
    @endforeach
</ul>


<div class="extra-services-list mt-25">
    <h5 class="mb-15">{{ __('Extra services') }}</h5>
    <ul class="list-group">
        @foreach($extras['optional'] as $extra)
            <li class="list-group-item">
                <div class="form-check
                    @if($extra->price > 0) has-price @endif">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        name="extra_ids[]"
                        id="extra-{{ $extra->id }}" 
                        value="{{ $extra->id }}" 
                        data-price="{{ $extra->price * count($travellers) }}"
                        {{ isset( $cart['extras'][ $extra->id ] ) ? 'checked' : '' }}
                        >
                    <label class="form-check
                        label" for="extra-{{ $extra->id }}">
                        <h5>{{ $extra->name }}</h5>
                        <p>{{ $extra->description }}</p>
                        @if($extra->price > 0)
                            <p>{{ $extra->price * count($travellers) }} {{ $currency }}</p>
                        @endif  
                    </label>
                </div>
            </li>
        @endforeach
    </ul>
</div>
-->
