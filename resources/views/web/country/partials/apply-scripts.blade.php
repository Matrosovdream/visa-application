
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
            traveler.find(".birthday-date").removeClass("hasDatepicker").attr('id', 'birthday-' + travelerCount);

            // Passport expiration date datepicker
            traveler.find(".expiration-date").removeClass("hasDatepicker").attr('id', 'expiration-' + travelerCount);

            updateDatePicker();

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
        var country_to = $('#country_to').val();


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

        if (country_to == null) {
            $('#country_to').after('<label class="error">This field is required</label>');
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

        // time_arrival validation, if selected in the next 5 days show message: 
        $('input[name="time_arrival"]').change(function() {

            var arrivalDate = $(this).val();
            var arrivalDateObj = new Date(arrivalDate);
            var today = new Date();
            var diffTime = arrivalDateObj - today;
            var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (diffDays < 5) {
                alert('You must select a date at least 5 days from today');
                $(this).val('');
            }

        });

        $('input[name="time_arrival"]').on('change', function() {
            const selectedDate = $(this).val();
            console.log("Selected date:", selectedDate);
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
        width: 23%;
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
