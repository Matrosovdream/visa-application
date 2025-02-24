<div class="relative w-full min-h-[60vh] md:min-h-[80vh] flex items-center justify-center">
    <img src="{{ asset('user/assets/img/hero/homepage-hero.webp') }}" class="w-full h-full object-cover" />

    <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
        <div>

            <form method="POST" action="{{ route('web.direction.apply') }}" id="search_direction"
                class="md:flex w-6xl p-4 bg-blue-50 bg-opacity-80 justify-center space-x-2 font-inter font-medium items-center rounded-xl shadow-lg">

                <div class="max-w-sm min-w-xs flex-grow" id="search_direction">

                    @csrf

                    <label for="countries1" class="block mb-2 text-sm font-light text-gray-900">
                        {{ __('Where am I from?') }}
                    </label>

                    <select
                        class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-10"
                        name="country_from">
                        <option selected disabled></option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" @if($location['countryCode'] == $country->code) selected @endif
                                data-flag="{{ asset('user/assets/img/flags/' . strtolower($country->slug) . '.svg') }}">
                                {{ $country->name }} - {{ $country->code }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="max-w-sm min-w-xs flex-grow">

                    <label for="countries2" class="block mb-2 text-sm font-light text-gray-900">
                        {{ __('Where am I going?') }}
                    </label>

                    <select
                        class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-10"
                        name="country_to">
                        <option selected disabled></option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}"
                                data-flag="{{ asset('user/assets/img/flags/' . strtolower($country->slug) . '.svg') }}">
                                {{ $country->name }} - {{ $country->code }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="rounded-lg mt-7 ml-2 bg-blue-600 px-4 py-2 text-white h-10 flex items-center"
                    type="submit">
                    {{ __('Get started!') }}
                </button>

            </form>

        </div>
    </div>
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