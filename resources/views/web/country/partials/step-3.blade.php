@if(isset($travellers) && count($travellers) > 0)

    @foreach($travellers as $traveller)

        <div class="card-traveller mt-25">

            <div class="row">
                <div class="col-md-6">
                    <h3>
                        {{ $traveller['name'] }} {{ $traveller['lastname'] }} - {{ __('Passport information') }}
                    </h3>
                </div>
                @php /*
                <div class="col-md-6 text-end">
                    <span class="btn-remove-traveller @if($loop->iteration == 1) hidden @endif">
                        <i class="bi bi-trash3 remove-traveller-icon"></i>
                    </span>
                </div>
                */ @endphp
            </div>

            <!-- Nationality -->
            <div class="mb-4 w-75">
                <label for="nationality" class="form-label">
                    {{ __("Nationality on passport") }}
                </label>
                <select class="select2" name="travellers[passport_issue_country][]">
                    @foreach($countries as $country)
                        <option></option>
                        <option 
                            value="{{ $country->slug }}" 
                            data-slug="{{ $country->slug }}" 
                            @if(
                                isset($traveller['passport_issue_country']) && $country->slug == $traveller['passport_issue_country']
                                ) selected @endif
                            >
                            {{ $country->name }} - {{ $country->code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 xb-item--field">
                <input 
                    type="checkbox" 
                    name="travellers[skip_pass][]" 
                    class="form-control-checkbox" 
                    @if( isset($traveller['skip_pass']) && $traveller['skip_pass'] == 'on' ) checked @endif
                    id="traveller-skip-pass-{{ $loop->iteration }}"
                    />
                <label class="form-label w-75" for="traveller-skip-pass-{{ $loop->iteration }}">
                    {{ __('Skip entering passport information for now') }}
                </label>
            </div>

            <div class="mb-3 xb-item--field traveller-pass-{{ $loop->iteration }}">
                <label for="arrivalDate" class="form-label w-100">
                    {{ __('Passport number') }}
                </label>
                <input 
                    type="text" 
                    name="travellers[passport][]" 
                    value="{{ $traveller['passport'] ?? '' }}"
                    class="form-control w-75" 
                    >
                <span class="icon"><img src="{{ asset('/user/assets/img/icon/c_user.svg') }}" alt=""></span>
            </div>

            <div class="mb-3 xb-item--field traveller-pass-{{ $loop->iteration }}">
                <label for="birthday" class="form-label w-100">
                    {{ __('Passport expiration date') }}
                </label>
                <input 
                    type="text" 
                    name="travellers[passport_expiration_date][]" 
                    value="{{ $traveller['passport_expiration_date'] ?? '' }}"
                    class="form-control w-50 datepicker-min-today expiration-date"
                    />
                <span class="icon"><img src="{{ asset('/user/assets/img/icon/calendar.svg') }}" alt=""></span>
            </div>

            <!-- Country of birth -->
            <div class="mb-4 w-75 traveller-pass-{{ $loop->iteration }}">
                <label for="nationality" class="form-label">
                    {{ __("Country of birth") }}
                </label>
                <select class="select2" name="travellers[birth_country][]">
                    @foreach($countries as $country)
                        <option></option>
                        <option 
                            value="{{ $country->slug }}" 
                            data-slug="{{ $country->slug }}" 
                            @if(
                                isset($traveller['birth_country']) && $country->slug == $traveller['birth_country']
                                ) selected @endif
                            >
                            {{ $country->name }} - {{ $country->code }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

    @endforeach

@else

    No travellers found.

@endif

<script>

    $(document).ready(function() {

        // Show/hide passport fields when skip checkbox is checked
        $('input[name="travellers[skip_pass][]"]').change(function() {
            var index = $(this).attr('id').split('-').pop();
            if($(this).is(':checked')) {
                $('.traveller-pass-' + index).hide();
            } else {
                $('.traveller-pass-' + index).show();
            }
        });

        // Check if skip checkbox is checked on load
        $('input[name="travellers[skip_pass][]"]').each(function() {
            var index = $(this).attr('id').split('-').pop();
            if($(this).is(':checked')) {
                $('.traveller-pass-' + index).hide();
            }
        });


    });

</script>