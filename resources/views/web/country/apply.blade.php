@extends('web.layouts.app')

@section('content')


<div class="container mt-2">

    <div class="row mb-10">
        <h1 class="">
            <span>{{ $product->name }} • {{ $product->getMeta('entries_number') }} entry </span>
        </h1>
    </div>

    <div class="row">

        <div class="step-indicator">
            <div id="step-indicator-1" class="active">1 | {{ __('Trip details') }}</div>
            <div id="step-indicator-2">2 | {{ __('Your info') }}</div>
            <div id="step-indicator-3">3 | {{ __('Checkout') }}</div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-8">
            <form id="multiStepForm" class="xb-item--form contact-from apply-form" method="POST"
                action="{{ route('web.order.create-apply') }}">

                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="country_to_id" value="{{ $country->id }}">
                <input type="hidden" name="country_to_code" value="{{ $country->code }}">
                <input type="hidden" name="country_from_id" value="{{ $countryFrom->id }}">
                <input type="hidden" name="country_from_code" value="{{ $countryFrom->code }}">

                <input type="hidden" name="product_price" value="{{ $totalPrice }}">
                <input type="hidden" name="product_extras_price" value="{{ $extrasPrice }}">

                <input type="hidden" name="currency" value="{{ $currency }}">
                <input type="hidden" name="quantity" value="1">

                <div id="step-1" class="form-step form-step-active">
                    <h3>Trip details</h3>

                    @include('web.country.partials.step-1')
                    
                    <button type="button" class="btn btn-primary" id="next-1">
                        {{ __('Next') }}
                    </button>
                </div>

                <div id="step-2" class="form-step form-step-active">

                    @include('web.country.partials.step-2')

                    <div class="mb-3 xb-item--field">
                        <button type="button" id="add_traveler" class="btn btn-primary w-100 mt-3">
                            {{ __('Add traveler') }}
                        </button>
                    </div>

                    <br />

                    <button type="button" class="btn btn-secondary" id="prev-2">
                        {{ __('Previous') }}
                    </button>
                    <button type="button" class="btn btn-primary" id="next-2">
                        {{ __('Next') }}
                    </button>

                </div>

                <div id="step-3" class="form-step form-step form-step-active1">
                    <h3>{{ __('Choose your processing time') }}</h3>

                    @include('web.country.partials.step-3')

                    <br />
                    <button type="button" class="btn btn-secondary" id="prev-3">
                        {{ __('Previous') }}
                    </button>

                </div>

                <div id="step-3" class="form-step">
                    <h3>{{ __('Checkout') }}</h3>
                    <p>{{ __('Confirm your details and proceed to checkout') }}</p>
                    <button type="button" class="btn btn-secondary" id="prev-3">
                        {{ __('Previous') }}
                    </button>
                    <button type="submit" class="btn btn-success">
                        {{ __('Save and Continue') }}
                    </button>
                </div>

            </form>
        </div>

        <!-- Sidebar Section -->
        <div class="col-md-4">
            <div class="sidebar">

                <table class="table summary-table">
                    <tbody>
                        <tr>
                            <td>
                                <h5>{{ $product->name }}</h5>
                            </td>
                            <td>
                                <p id="traveler-count">1 {{ __('traveler') }}</p>
                            </td>
                        </tr>

                        @foreach($product->extras as $extra) 
                            <tr>
                                <td>+ {{ $extra->name }}</td>
                                <td>
                                    <span id="extras-price-span">
                                        {{ $extra->price }}
                                        {{ $currency }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td>+ {{ __('Service fees') }}</td>
                            <td>
                                <span id="price-span">{{ $product->offers->first()->price }} {{ $currency }}</span>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <button type="button" class="btn btn-primary w-100 mt-3 pay-button">
                    {{ __('Pay order') }}
                </button>

            </div>
        </div>
    </div>
</div>

<br />
<br />



<script>
    $(document).ready(function () {

        calcTotals();

        // Step navigation logic
        function updateStepIndicator(step) {
            $('.step-indicator div').removeClass('active');
            $('#step-indicator-' + step).addClass('active');
            if (step == 3) {
                $('.pay-button').show();
            } else {
                $('.pay-button').hide();
            }
        }

        $('#next-1').click(function () {
            if (validate_step1()) {
                $('#step-1').removeClass('form-step-active');
                $('#step-2').addClass('form-step-active');
                updateStepIndicator(2);
            }
        });

        $('#next-2').click(function () {
            if (validate_step2()) {
                $('#step-2').removeClass('form-step-active');
                $('#step-3').addClass('form-step-active');
                updateStepIndicator(3);
            }
        });

        $('#prev-2').click(function () {
            $('#step-2').removeClass('form-step-active');
            $('#step-1').addClass('form-step-active');
            updateStepIndicator(1);
        });

        $('#prev-3').click(function () {
            $('#step-3').removeClass('form-step-active');
            $('#step-2').addClass('form-step-active');
            updateStepIndicator(2);
        });

        // Add traveler logic
        var travelerCount = 1;
        $('#add_traveler').click(function () {

            // Clone the element and append it to the form
            var traveler = $('.card-traveler').first().clone();
            travelerCount++;
            traveler.find('h3').text('Traveler #' + travelerCount);
            $('.card-traveler').last().after(traveler);

            // clean the fields
            traveler.find('input').val('');

            // Birthday datepicker
            traveler.find(".birthday-date").removeClass("hasDatepicker").attr('id', 'birthday-' + travelerCount).datepicker({});

            // Passport expiration date datepicker
            traveler.find(".expiration-date").removeClass("hasDatepicker").attr('id', 'expiration-' + travelerCount).datepicker({ minDate: new Date() });




            // Update traveler count
            $('#traveler-count').text(travelerCount + ' travelers');
            $('input[name="quantity"]').val(travelerCount);

            // Update price with currency
            calcTotals();


        });

        // Remove traveler logic
        $(document).on('click', '.btn-remove-traveler', function () {
            $(this).closest('.card-traveler').remove();
            travelerCount--;
            $('#traveler-count').text(travelerCount + ' travelers');
            $('input[name="quantity"]').val(travelerCount);
            calcTotals();
        });

        // Offer selection logic
        $('input[name="offer_id"]').change(function () {
            var price = $(this).data('price');
            $('input[name="product_price"]').val(price);
            calcTotals();
        });

        // Submit form
        $('.pay-button').click(function () {
            $('#multiStepForm').submit();
        });

    });

    function validate_step1() {

        // Manual validation
        var arrivalDate = $('#arrivalDate').val();
        var fullName = $('#full_name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();

        var isValid = true;

        $('label.error').remove();

        // Check all fields and if not valid, show error label.error after the fields
        if (arrivalDate == '') {
            $('#arrivalDate').after('<label class="error">This field is required</label>');
            isValid = false;
        }

        if (fullName == '') {
            $('#full_name').after('<label class="error">This field is required</label>');
            isValid = false;
        }

        if (phone == '') {
            $('#phone').after('<label class="error">This field is required</label>');
            isValid = false;
        }

        if (email == '' || !check_email(email)) {
            $('#email').after('<label class="error">Check email</label>');
            isValid = false;
        }

        // Validate phone
        if (!validatePhone(phone)) {
            //$('#phone').after('<label class="error">Check phone</label>');
            //isValid = false;
        }

        return isValid;

    }

    function validate_step2() {

        // Check all traveller fields
        var isValid = true;

        $('label.error').remove();

        // Check all fields and if not valid, show error label.error after the fields
        $('input[name^="travelers[name]"]').each(function () {
            if ($(this).val() == '') {
                $(this).after('<label class="error">This field is required</label>');
                isValid = false;
            }
        });

        $('input[name^="travelers[lastname]"]').each(function () {
            if ($(this).val() == '') {
                $(this).after('<label class="error">This field is required</label>');
                isValid = false;
            }
        });

        $('input[name^="travelers[birthday]"]').each(function () {
            if ($(this).val() == '') {
                $(this).after('<label class="error">This field is required</label>');
                isValid = false;
            }
        });

        $('input[name^="travelers[passport]"]').each(function () {
            if ($(this).val() == '') {
                $(this).after('<label class="error">This field is required</label>');
                isValid = false;
            }
        });

        return isValid;

    }

    function check_email(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    function calcTotals() {

        var price = parseFloat($('input[name="product_price"]').val());
        var extras_price = parseFloat($('input[name="product_extras_price"]').val());
        var currency = '{{ $currency }}';
        var travelerCount = $('input[name="quantity"]').val();

        // Update price with currency
        $('#price-span').text(price * travelerCount + ' ' + currency);
        $('#extras-price-span').text(extras_price * travelerCount + ' ' + currency);

    }

    // Phone validation func
    function validatePhone(phone) {
        var re = /^\d{10}$/;
        return re.test(phone);
    }

</script>



<style>
    label.error {
        color: red;
        font-size: 14px;
    }

    .pay-button {
        display: none;
    }

    .summary-table {
        --tw-bg-opacity: 1;
        background-color: rgb(248 249 249 / var(--tw-bg-opacity));
    }

    .step-indicator {
        display: flex;
        justify-content: space-around;
        margin-bottom: 30px;
        padding: 10px;
    }

    .step-indicator div {
        text-align: center;
        width: 30%;
        padding: 5px 0;
        border: 1px solid #d4d4d4;
        border-radius: 30px;
        background-color: #f8f9fa;
        color: #6c757d;
        font-weight: bold;
    }

    .step-indicator .active {
        background-color: #0d6efd;
        color: white;
        border: 1px solid #0d6efd;
    }

    /* Form Styling */
    .form-step {
        display: none;
    }

    .form-step-active {
        display: block;
    }

    .form-label {
        font-weight: 500;
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004080;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    h3 {
        margin-bottom: 20px;
    }
    .btn-remove-traveler {
        color: red;
        cursor: pointer;
        font-size: 15px;
    }
    /* Hide if it's the first traveller block */
    .card-traveler:first-child .btn-remove-traveler {
        display: none;
    }
</style>

@endsection