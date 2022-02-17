<div
    id="cookiebar-banner"
    class="fixed bottom-0 w-full py-4 text-cookiebar-banner-secondary bg-cookiebar-banner-primary shadow-top js-cookiebar cookiebar z-50"
>
    <div class="container mx-auto flex flex-col items-center justify-center text-center lg:text-left space-y-4">

        <span class="cookiebar__message">
            {!! trans('cookiebar::banner.message') !!}
        </span>

        <div class="flex flex-col items-center justify-center space-y-4">
            <div class="flex justify-center items-center space-x-4">
                <button data-cookiebar="modal-show"
                    class="ml-8 bg-cookiebar-banner-secondary bg-opacity-0 text-cookiebar-banner-secondary border border-cookiebar-banner-secondary hover:bg-opacity-25 font-bold text-sm uppercase px-3 py-2 lg:px-4 lg:py-2 rounded-full flex flex-row items-center justify-center js-cookiebar-manage">
                    {{ trans('cookiebar::banner.manage') }}
                </button>
                <button data-cookiebar="update-consent"
                    class="ml-8 bg-cookiebar-banner-secondary bg-opacity-100 hover:bg-black text-black hover:text-cookiebar-banner-secondary border border-black hover:border-cookiebar-banner-secondary font-bold text-sm uppercase px-3 py-2 lg:px-4 lg:py-2 rounded-full flex flex-row items-center justify-center js-cookiebar-agree">
                    {{ trans('cookiebar::banner.agree') }}
                </button>
            </div>

            <button data-cookiebar="update-consent"
                class="mt-2 ml-8 underline text-xs js-cookiebar-dismiss">
                {{ trans('cookiebar::banner.dismiss') }}
            </button>
        </div>

    </div>
</div>
