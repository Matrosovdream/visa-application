<form method="POST" action="{{ route('web.direction.apply') }}" id="search_direction">
    @csrf

    <div class="relative top-20 w-full min-h-[60vh] md:min-h-[80vh] flex items-center justify-center">
        <img src="{{ asset('user/assets/img/hero/homepage-hero.webp') }}"
            class="absolute inset-0 w-full h-full object-cover" />

        <div
            class="relative z-10 w-full max-w-[70%] md:max-w-4xl p-4 bg-gray-50 bg-opacity-80 flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0 md:space-x-4 font-inter font-medium rounded-3xl">

            <div class="w-full max-w-xs flex-grow">
                <label for="countries1" class="block mb-2 font-light text-evisablack">
                    {{ __('Where am I from?') }}
                </label>
                <select id="countries1" name="country_from"
                    class="select2 bg-gray-50 border-solid border-2 border-evisasuperlight text-evisablack rounded-lg focus:ring-evisalightblue focus:border-evisalightblue block w-full p-3 h-auto">
                    <option selected disabled></option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" @if($location['countryCode'] == $country->code) selected @endif
                            data-flag="{{ App\Helpers\countryHelper::getFlagUrl($country->code) }}">
                            {{ $country->name }} - {{ $country->code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-full max-w-xs flex-grow">
                <label for="countries2" class="block mb-2 font-light text-evisablack">
                    {{ __('Where am I going?') }}
                </label>
                <select id="countries2" name="country_to"
                    class="select2 bg-gray-50 border-solid border-2 border-evisasuperlight text-evisablack rounded-lg focus:ring-evisalightblue focus:border-evisalightblue block w-full p-3 h-auto">
                    <option selected disabled></option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}"
                            data-flag="{{ App\Helpers\countryHelper::getFlagUrl($country->code) }}">
                            {{ $country->name }} - {{ $country->code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button
                type="submit"
                class="md:mt-8 px-4 py-6 rounded-lg bg-evisablue text-white hover:bg-evisabluekhover whitespace-nowrap h-10 flex items-center">
                {{ __('Get started!') }}
            </button>

        </div>

    </div>
</form>


<script type="text/javascript">

    $(document).ready(function () {
        $('#search_direction').validate({
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