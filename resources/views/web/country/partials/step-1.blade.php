<div class="mb-3 xb-item--field">

    <label for="arrivalDate" class="form-label w-100">
        {{ __('When do you arrive in') }}
        {{ $country->name }}?</label>
    <input type="text" class="form-control w-50 datepicker-min-today min-5-alert" name="time_arrival" id="arrivalDate" required>
    <span class="icon"><img src="{{ asset('/user/assets/img/icon/calendar.svg') }}" alt=""></span>

    <div class="alert hidden application-alert">
        <p class="text-danger min-5-alert-text">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <b>{{ __('Your trip is very soon') }}</b>
        </p>
        <p class="">
            {{ __('Please complete your application at once to get your documents as quickly as possible.') }}
        </p>
    </div>

</div>

<div class="mb-3 xb-item--field">

    <label for="arrivalDate" class="form-label w-100">
        {{ __('Which airport do you arrive?') }}
        {{ $country->name }}?</label>
    <div class="w-50">   
        <select class="select2" name="country_to" id="country_to">
            <option selected disabled></option>
            @foreach($airports as $airport)
                <option value="{{ $airport->id }}">
                    {{ $airport->name }} - {{ $airport->identity }}
                </option>
            @endforeach
        </select>
    </div> 
    <p class="form-note">
        If your arrival point isn't listed, we can't process your request.
    </p>
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
    <p class="form-note">
        {{ __('We use this to create your account and send you updates about your application.') }}
    </p>
</div>

<br/>
<div class="mb-3 xb-item--field">
    <label for="email" class="form-label  w-100">
        {{ __('I want to receive VisaTrips updates, product launches and personalized offers. I can opt out anytime.') }}
    </label>
    <div class="agree-updates">
        <input class="form-check" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">{{ __('Yes, I want to receive updates') }}</label>
    </div>
</div>