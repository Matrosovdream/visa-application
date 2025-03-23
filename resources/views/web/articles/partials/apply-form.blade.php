<div class="w-full lg:w-[30%] bg-blue-50 p-6 rounded-lg shadow ml-auto">

    <form method="POST" action="{{ route('web.direction.apply') }}" id="search_direction">
        @csrf

        <h2 class="text-2xl font-semibold text-gray-900 text-center">
            {{ __('Start your application') }}
        </h2>

        <div class="mt-4">
            <label class="block text-gray-700 font-medium mb-2">
                {{ __('Where are you from?') }}
            </label>
            <div class="relative">
                <select id="countries1" name="country_from"
                    class="select2 bg-gray-50 border-solid border-2 border-evisasuperlight text-evisablack rounded-lg focus:ring-evisalightblue focus:border-evisalightblue block w-full p-3 h-auto">
                    <option selected disabled></option>

                    @foreach($references['countries']['items'] as $country)
                        <option value="{{ $country['id'] }}"
                            data-flag="{{ App\Helpers\countryHelper::getFlagUrl($country['code']) }}">
                            {{ $country['title'] }} - {{ $country['code'] }}
                        </option>
                    @endforeach

                </select>
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-gray-700 font-medium mb-2">
                {{ __('Where are you going?') }}
            </label>
            <div class="relative">
                <select id="countries2" name="country_to"
                    class="select2 bg-gray-50 border-solid border-2 border-evisasuperlight text-evisablack rounded-lg focus:ring-evisalightblue focus:border-evisalightblue block w-full p-3 h-auto">
                    <option selected disabled></option>

                    @foreach($references['countries']['items'] as $country)
                        <option value="{{ $country['id'] }}"
                            data-flag="{{ App\Helpers\countryHelper::getFlagUrl($country['code']) }}">
                            {{ $country['title'] }} - {{ $country['code'] }}
                        </option>
                    @endforeach

                </select>
            </div>
        </div>

        <button
            class="mt-6 w-full bg-green-500 text-white py-3 rounded-lg font-medium text-lg hover:bg-green-600 flex items-center justify-center gap-2">
            {{ __('Apply Now!') }} →
        </button>

    </form>

</div>


<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#search_direction').validate({
            rules: {
                country_from: {
                    required: true
                },
                country_to: {
                    required: true
                }
            },
            messages: {
                country_from: {
                    required: "Please select your country of origin"
                },
                country_to: {
                    required: "Please select your destination country"
                }
            },
            /*errorPlacement: function (error, element) {
                $(element).closest('tr').next().find('.error_label').html(error);
            },*/
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>

<style>
    /* Simple styling for error messages */
    label.error {
        color: red;
        font-size: 14px;
    }
</style>