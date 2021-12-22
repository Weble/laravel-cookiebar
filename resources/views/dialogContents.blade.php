{{--<div class="js-cookie-consent cookie-consent fixed bottom-0 inset-x-0 pb-2 w-full">--}}
{{--    <div class="max-w-7xl mx-auto px-6">--}}
{{--        <div class="p-2 rounded-lg bg-yellow-100">--}}
{{--            <div class="flex items-center justify-between flex-wrap">--}}
{{--                <div class="w-0 flex-1 items-center hidden md:inline">--}}
{{--                    <p class="ml-3 text-yellow-600 cookie-consent__message">--}}
{{--                        {!! __('cookie-consent::texts.message') !!}--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--                <div class="mt-2 flex-shrink-0 w-full sm:mt-0 sm:w-auto">--}}
{{--                    <a class="js-cookie-consent-agree cookie-consent__agree cursor-pointer flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-yellow-800 bg-yellow-400 hover:bg-yellow-300">--}}
{{--                        {{ __('cookie-consent::texts.agree') }}--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="fixed bottom-0 w-full py-4 text-white shadow-top js-cookie-consent cookie-consent z-50">
    <div class="container mx-auto flex flex-col lg:flex-row items-center justify-center text-center lg:text-left  space-y-4 lg:space-y-0">

        <span class="cookie-consent__message">
            {!! __('cookieConsent::texts.message') !!}
        </span>

        <div class="flex flex-col items-center justify-center space-y-4">
            <button
                class="ml-8 bg-white text-blue-cta font-bold text-sm uppercase px-3 py-2 lg:px-4 lg:py-2 rounded-full flex flex-row items-center justify-center js-cookie-consent-agree cookie-consent__agree">
                {{ __('cookieConsent::texts.agree') }}
            </button>

            <button class="mt-2 ml-8 underline text-xs js-cookie-consent-dismiss cookie-consent__dismiss">
                {{ __('cookieConsent::texts.dismiss') }}
            </button>
        </div>

    </div>
</div>
