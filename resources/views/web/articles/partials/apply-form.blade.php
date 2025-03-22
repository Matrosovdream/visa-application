<div class="w-full lg:w-[30%] bg-blue-50 p-6 rounded-lg shadow ml-auto">
    <h2 class="text-2xl font-semibold text-gray-900 text-center">
        {{ __('Start your application') }}
    </h2>

    <div class="mt-4">
        <label class="block text-gray-700 font-medium mb-2">
            {{ __('Where are you from?') }}
        </label>
        <div class="relative">
            <select class="w-full p-3 border border-gray-300 rounded-lg bg-white">
                <option selected>🇷🇸 Serbia</option>
            </select>
        </div>
    </div>

    <div class="mt-4">
        <label class="block text-gray-700 font-medium mb-2">
            {{ __('Where are you going?') }}
        </label>
        <div class="relative">
            <select class="w-full p-3 border border-gray-300 rounded-lg bg-white">
                <option selected>
                    {{ __('Select a destination') }}
                </option>
            </select>
        </div>
    </div>

    <button
        class="mt-6 w-full bg-green-500 text-white py-3 rounded-lg font-medium text-lg hover:bg-green-600 flex items-center justify-center gap-2">
        {{ __('Apply Now!') }} →
    </button>
</div>