<script>

    $(document).ready(function () {

        $('form.fields-loop-form').submit(function (e) {

            var isValid = true;
            $('label.error').remove();

            $(this).find('input, select, textarea').each(function () {
                var $this = $(this);
                var value = $this.val();
                var required = $this.hasClass('required');

                if (required && value == '') {
                    $this.after('<label class="error">This field is required</label>');
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
            }

        });

    });

</script>