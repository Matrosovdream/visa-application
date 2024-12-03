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