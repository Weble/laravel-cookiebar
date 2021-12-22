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
<div class="fixed bottom-0 w-full py-4 text-white bg-black shadow-top js-cookie-consent cookie-consent z-50">
    <div class="container mx-auto flex flex-col items-center justify-center text-center lg:text-left space-y-4">

        <span class="cookie-consent__message">
            {!! trans('cookie-consent::texts.message') !!}
        </span>

        <div class="flex flex-col items-center justify-center space-y-4">
            <div class="flex justify-center items-center space-x-4">
                <button
                    class="ml-8 bg-white bg-opacity-0 text-white border border-white hover:bg-opacity-25 font-bold text-sm uppercase px-3 py-2 lg:px-4 lg:py-2 rounded-full flex flex-row items-center justify-center js-cookie-consent-agree cookie-consent__agree">
                    {{ trans('cookie-consent::texts.manage') }}
                </button>
                <button
                    class="ml-8 bg-white bg-opacity-100 hover:bg-black text-black hover:text-white border border-black hover:border-white font-bold text-sm uppercase px-3 py-2 lg:px-4 lg:py-2 rounded-full flex flex-row items-center justify-center js-cookie-consent-agree cookie-consent__agree">
                    {{ trans('cookie-consent::texts.agree') }}
                </button>
            </div>

            <button class="mt-2 ml-8 underline text-xs js-cookie-consent-dismiss cookie-consent__dismiss">
                {{ trans('cookie-consent::texts.dismiss') }}
            </button>
        </div>

    </div>
</div>
