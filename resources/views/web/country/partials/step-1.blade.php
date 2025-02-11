@include('web.partials.fields-loop', 
[
    'values' => $cartFieldValues, 
    'fields' => $formFields,
    'entity' => 'order'
    ])


<script>

    $(document).ready(function() {
        $('form.apply-form').submit(function(e) {
            // Validate step 1
            if (!validate_step1()) {
                e.preventDefault();
            }
        });
    });

    function validate_step1() {

        // Manual validation
        var arrivalDate = $('#field-arrival_date').val();
        var fullName = $('#field-full_name').val();
        var phone = $('#field-phone_number').val();
        var email = $('#field-email').val();
        var country_to = $('#country_to').val();


        var isValid = true;

        $('label.error').remove();

        // Check all fields and if not valid, show error label.error after the fields
        if (arrivalDate == '') {
            $('#field-arrival_date').after('<label class="error">This field is required</label>');
            isValid = false;
        }

        if (fullName == '') {
            $('#field-full_name').after('<label class="error">This field is required</label>');
            isValid = false;
        }

        if (phone == '') {
            $('#field-phone_number').after('<label class="error">This field is required</label>');
            isValid = false;
        }

        
        if (email == '' || !check_email(email)) {
            $('#field-email').after('<label class="error">Check email</label>');
            isValid = false;
        }
        
        /*if (country_to == null) {
            $('#country_to').after('<label class="error">This field is required</label>');
            isValid = false;
        }*/

        // Validate phone
        if (!validatePhone(phone)) {
            //$('#phone').after('<label class="error">Check phone</label>');
            //isValid = false;
        }


        return isValid;

    }

</script>