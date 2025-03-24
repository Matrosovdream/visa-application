<footer class="relative top-60 p-6 bg-white sm:p-6">
    <div class="mx-auto">
        <div class="md:flex md:justify-between font-inter font-medium">
            <div class="md:flex flex-col">
                <div class="mb-6 text-xs md:text-sm">
                    <h2>
                        {{ __('Do you have questions or went more information? Contact us now') }}
                    </h2>
                    <p class="mb-2">Contact us now</p>
                    <p class="mb-2">
                        📞 {{ $siteSettings['phone'] }}
                    </p>
                    <p class="mb-2">
                        ✉️ {{ $siteSettings['email'] }}
                    </p>
                </div>

                <div class="mb-6 text-xs md:text-sm md:mb-0">
                    <h3 class="mb-2 text-xs md:text-sm font-medium text-evisablack">
                        Subscribe to our blog
                    </h3>
                    <p class="mb-4 text-evisamedium font-normal text-xs md:text-sm">
                        The latest news, articles, and resources, sent to your inbox
                        weekly.
                    </p>
                    <div>

                        @include('web.forms.subscribe-footer')

                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8 mt-4 sm:gap-20 sm:grid-cols-3">
                <div>
                    <h2 class="mb-2 md:mb-6 text-xs md:text-sm text-evisablack">
                        Services
                    </h2>
                    <ul class="text-evisamedium">
                        <li class="mb-4">
                            <a href="" class="hover:text-evisablackhover text-xs md:text-sm font-normal">Tourist
                                visa</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-2 md:mb-6 text-xs md:text-sm text-evisablack">
                        Company
                    </h2>
                    <ul class="text-evisamedium">
                        <li class="mb-1 md:mb-4">
                            <a href="" class="hover:text-evisablackhover text-xs md:text-sm font-normal">About us</a>
                        </li>
                        <li>
                            <a href="" class="hover:text-evisablackhover text-xs md:text-sm font-normal">Blog</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-2 md:mb-6 text-xs md:text-sm text-evisablack">
                        Our branches
                    </h2>
                    <ul class="text-evisamedium">
                        <li class="mb-0 md:mb-4">
                            <a href="#" class="hover:text-evisablackhover text-xs md:text-sm font-normal">Canada</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="my-6 h-0.5 bg-evisasuperlight sm:mx-auto lg:my-8"></div>

        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-xs md:text-sm text-evisamedium sm:text-center">
                © {{ $siteSettings['copyright_text'] }}
            </span>
            <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                <a href="#" class="text-evisamedium hover:text-gray-900">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</footer>