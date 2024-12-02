
<script>
    $(document).ready(function () {

        //calcTotals();

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

        // Add traveller logic
        var travellerCount = 1;
        $('#add_traveller').click(function () {

            // Clone the element and append it to the form
            var traveller = $('.card-traveller').first().clone();
            travellerCount++;
            traveller.find('h3').text('Traveler #' + travellerCount);
            $('.card-traveller').last().after(traveller);

            // clean the fields
            traveller.find('input').val('');

            

            // Birthday datepicker
            traveller.find(".birthday-date").removeClass("hasDatepicker").attr('id', 'birthday-' + travellerCount);

            // Passport expiration date datepicker
            traveller.find(".expiration-date").removeClass("hasDatepicker").attr('id', 'expiration-' + travellerCount);

            updateDatePicker();

            // Update traveller count
            $('#traveller-count').text(travellerCount + ' travellers');
            $('input[name="quantity"]').val(travellerCount);

            // Update price with currency
            calcTotals();

        });

        // Remove traveller logic
        $(document).on('click', '.btn-remove-traveller', function () {
            $(this).closest('.card-traveller').remove();
            travellerCount--;
            $('#traveller-count').text(travellerCount + ' travellers');
            $('input[name="quantity"]').val(travellerCount);
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

    function check_email(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    function calcTotals() {

        var price = parseFloat($('input[name="product_price"]').val());
        var extras_price = parseFloat($('input[name="product_extras_price"]').val());
        var currency = '{{ $currency }}';
        var travellerCount = $('input[name="quantity"]').val();

        // Update price with currency
        $('#price-span').text(price * travellerCount + ' ' + currency);
        $('#extras-price-span').text(extras_price * travellerCount + ' ' + currency);

    }

    // Phone validation func
    function validatePhone(phone) {
        var re = /^\d{10}$/;
        return re.test(phone);
    }

</script>




