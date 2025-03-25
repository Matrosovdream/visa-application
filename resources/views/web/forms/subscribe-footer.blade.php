<form method="POST" action="{{ route('api.subscribe') }}" id="subscribe-footer-form">
    @csrf

    <div class="font-inter flex space-x-4 font-medium">
        <input type="text" name="email" placeholder="Enter your email"
            class="w-80 px-3 rounded-lg outline-solid outline-2 outline-evisasuperlight" />

        <button type="submit" class="w-auto rounded-lg bg-evisablue hover:bg-evisabluekhover px-4 py-2 text-white">
            Subscribe
        </button>
    </div>

    <div>
        <span class="text-xs text-red-500 alert-message hidden">
            {{ __('Please enter a valid email address') }}
        </span>
        <span class="text-xs text-green-500 success-message hidden"></span>
    </div>

</form>

<script>
    /*
    $(document).ready(function () {

        $('#subscribe-footer-form').submit(function (e) {

            e.preventDefault();

            $('.alert-message').addClass('hidden');
            $('.success-message').addClass('hidden');

            var form = $(this);
            var email = $(this).find('input[name="email"]').val();
            var url = form.attr('action');
            var data = form.serialize();

            // Validate input name email
            if (data.email == '' || !validateEmail(email)) {
                $('.alert-message').removeClass('hidden');
                $('.alert-message').text('{{ __('Please enter a valid email address') }}');
                return;
            } else {
                $('.alert-message').addClass('hidden');
            }

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function (response) {

                    // If response.success
                    if (response.status == 'success') {

                        $('.success-message').removeClass('hidden');
                        $('.success-message').text(response.message);

                        form.trigger('reset');
                    } else {

                        $('.alert-message').removeClass('hidden');
                        $('.alert-message').text(response.message);
                        
                    }
                },
                error: function (response) {
                    
                }
            });

        });

    });

    // Validate email function
    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }
    */
</script>