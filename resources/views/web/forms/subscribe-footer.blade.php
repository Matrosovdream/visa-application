<form method="POST" action="{{ route('api.subscribe') }}" class="font-inter flex space-x-4 font-medium">
    @csrf

    <input type="email" name="email" placeholder="Enter your email"
        class="w-80 px-3 rounded-lg outline-solid outline-2 outline-evisasuperlight" />

    <button type="submit" class="w-auto rounded-lg bg-evisablue hover:bg-evisabluekhover px-4 py-2 text-white">
        Subscribe
    </button>

</form>