<div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">

    <!-- Errors from flash -->
    @if (session('error'))
        @foreach(session('error') as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <h2 class="text-xl font-semibold mb-4">Payment details</h2>

    <form class="space-y-6" action="{{ route('charge') }}" method="post">
        @csrf

        <input type="hidden" name="order_id" value="{{ $order->id }}" />

        <div>
            <label class="block text-evisamedium mb-1">Card number</label>
            <input
              type="number"
              class="block w-full px-3 py-2 border-solid border-2 border-evisasuperlight hover:border-evisalightblue focus:outline-0 focus:border-evisalightblue rounded-lg"
              value="370000000000002"
              name="cc_number"
            />
          </div>

          <div class="flex space-x-2">
            <div>
              <label class="block text-evisamedium mb-1">Month</label>
              <input
                type="number"
                placeholder="Month"
                class="block w-full px-3 py-2 border-solid border-2 border-evisasuperlight hover:border-evisalightblue focus:outline-0 focus:border-evisalightblue rounded-lg"
                value="12"
                name="expiry_month"
              />
            </div>
            <div>
              <label class="block text-evisamedium mb-1">Year</label>
              <input
                type="number"
                placeholder=""
                class="block w-full px-3 py-2 border-solid border-2 border-evisasuperlight hover:border-evisalightblue focus:outline-0 focus:border-evisalightblue rounded-lg"
                value="25"
                name="expiry_year"
              />
            </div>
          </div>

          <div>
            <label class="block text-evisamedium mb-1">CVV</label>
            <input
              type="number"
              placeholder="CVV"
              class="block w-full px-3 py-2 border-solid border-2 border-evisasuperlight hover:border-evisalightblue focus:outline-0 focus:border-evisalightblue rounded-lg"
              value="123"
              name="cvv"
            />
          </div>


          <div class="border-t border-gray-300 pt-4">
            <div class="flex justify-between items-center">
              <span class="text-evisablack font-semibold text-"
                >Payment amount:</span
              >
              <span class="text-xl font-semibold">
                {{ $order->getTotal() }} {{ $order->getCurrency() }}
              </span>
            </div>
          </div>

          <button
            type="submit"
            class="mt-2 w-full bg-evisablue text-white font-medium py-2 rounded-xl hover:bg-evisabluekhover"
            value="Pay"
            >
            Pay order
          </button>

    </form>

</div>