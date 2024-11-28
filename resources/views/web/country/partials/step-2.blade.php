<div class="card-traveler mt-25">

    <div class="row">
        <div class="col-md-6">
            <h3>
                {{ __('Traveler') }} #1
            </h3>
        </div>
        <div class="col-md-6 text-end">
            <span class="btn-remove-traveler">
                <i class="bi bi-trash3 remove-traveller-icon"></i>
            </span>
        </div>
    </div>

    <div class="mb-3 xb-item--field">
        <label class="form-label w-100">
            {{ __('First and middle name') }}
        </label>
        <input type="text" name="travelers[name][]" class="form-control w-75" required>
        <span class="icon"><img src="{{ asset('/user/assets/img/icon/c_user.svg') }}" alt=""></span>
    </div>

    <div class="mb-3 xb-item--field">
        <label class="form-label w-100">
            {{ __('Last name') }}
        </label>
        <input type="text" name="travelers[lastname][]" class="form-control w-75" required>
        <span class="icon"><img src="{{ asset('/user/assets/img/icon/c_user.svg') }}" alt=""></span>
    </div>

    <div class="mb-3 xb-item--field">
        <label for="birthday" class="form-label w-100">
            {{ __('Birthday') }}
        </label>
        <input type="text" class="form-control w-50 datepicker-birthday birthday-date" name="travelers[birthday][]"
            id="birthday-1" required>
        <span class="icon"><img src="{{ asset('/user/assets/img/icon/c_user.svg') }}" alt=""></span>
    </div>

    <div class="mb-3 xb-item--field">
        <label for="arrivalDate" class="form-label w-100">
            {{ __('Passport number') }}
        </label>
        <input type="text" name="travelers[passport][]" class="form-control w-75" id="arrivalDate" required>
        <span class="icon"><img src="{{ asset('/user/assets/img/icon/c_user.svg') }}" alt=""></span>
    </div>

    <div class="mb-3 xb-item--field">
        <label for="birthday" class="form-label w-100">
            {{ __('Passport expiration date') }}
        </label>
        <input type="text" class="form-control w-50 datepicker-min-today expiration-date"
            name="travelers[passport_expiration_date][]" id="expiration-1" required>
        <span class="icon"><img src="{{ asset('/user/assets/img/icon/c_user.svg') }}" alt=""></span>
    </div>

</div>