<div class="mb-3 xb-item--field">

    <label for="arrivalDate" class="form-label w-100">
        {{ __('When do you arrive in') }}
        {{ $country->name }}?</label>
    <input type="text" class="form-control w-50 datepicker-min-today" name="time_arrival" id="arrivalDate" required>
    <span class="icon"><img src="{{ asset('/user/assets/img/icon/location-2.svg') }}" alt=""></span>
</div>

<div class="mb-3 xb-item--field">

    <label for="arrivalDate" class="form-label w-100">
        {{ __('Which airport do you arrive?') }}
        {{ $country->name }}?</label>
    <select class="nice-select1 form-control w-50" name="country_to">
        <option selected disabled></option>
        @foreach($airports as $airport)
            <option value="{{ $airport->id }}">
                {{ $airport->name }} - {{ $airport->identity }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3 xb-item--field">
    <label for="full_name" class="form-label  w-100">
        {{ __('Your full name') }}
    </label>
    <input type="text" class="form-control w-75" id="full_name" name="full_name" required>
    <span class="icon"><img src="{{ asset('/user/assets/img/icon/c_user.svg') }}" alt=""></span>
</div>

<div class="mb-3 xb-item--field">
    <label for="phone" class="form-label  w-100">
        {{ __('Phone number') }}
    </label>
    <input type="tel" class="form-control w-75" id="phone" name="phone" required>
    <span class="icon"><img src="{{ asset('/user/assets/img/icon/c_call.svg') }}" alt=""></span>
</div>

<div class="mb-3 xb-item--field">
    <label for="email" class="form-label  w-100">
        {{ __('Email address') }}
    </label>
    <input type="email" class="form-control w-75" id="email" name="email" placeholder="example@mail.com" required>
    <span class="icon"><img src="{{ asset('/user/assets/img/icon/c_mail.svg') }}" alt=""></span>
</div>