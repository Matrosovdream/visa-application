<script>

    $(document).ready(function () {

        $('form.fields-loop-form').submit(function (e) {

            var isValid = true;
            $('label.error').remove();

            $(this).find('input, select, textarea').each(function () {
                var $this = $(this);
                var value = $this.val();
                var required = $this.hasClass('required');

                console.log( value );

                if (required && ( value == '' || value == null )) {

                    var isSelect2 = $this.hasClass('select2-hidden-accessible');

                    if( isSelect2 ) {
                        $(this).parent().find('.select2-selection').after('<label class="error">This field is required</label>');
                    } else {
                        $this.after('<label class="error">This field is required</label>');
                    }

                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
            }

        });

    });

</script>