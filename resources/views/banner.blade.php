<div
    id="cookiebar-banner"
    class="cb-fixed cb-bottom-0 cb-w-full cb-py-4 cb-text-white cb-bg-black cb-shadow-top js-cookiebar cookiebar cb-z-50"
>
    <div class="cb-container cb-mx-auto cb-flex cb-flex-col cb-items-center cb-justify-center cb-text-center lg:cb-text-left cb-space-y-4">

        <span class="cookiebar__message">
            {!! trans('cookiebar::banner.message') !!}
        </span>

        <div class="cb-flex cb-flex-col cb-items-center cb-justify-center cb-space-y-4">
            <div class="cb-flex cb-justify-center cb-items-center cb-space-x-4">
                <button data-cookiebar="modal-show"
                    class="cb-ml-8 cb-bg-white cb-bg-opacity-0 cb-text-white cb-border cb-border-white hover:cb-bg-opacity-25 cb-font-bold cb-text-sm cb-uppercase cb-px-3 cb-py-2 lg:cb-px-4 lg:cb-py-2 cb-rounded-full cb-flex cb-flex-row cb-items-center cb-justify-center js-cookiebar-manage">
                    {{ trans('cookiebar::banner.manage') }}
                </button>
                <button data-cookiebar="update-consent"
                    class="cb-ml-8 cb-bg-white cb-bg-opacity-100 hover:cb-bg-black cb-text-black hover:cb-text-white cb-border cb-border-black hover:cb-border-white cb-font-bold cb-text-sm cb-uppercase cb-px-3 cb-py-2 lg:cb-px-4 lg:cb-py-2 cb-rounded-full cb-flex cb-flex-row cb-items-center cb-justify-center js-cookiebar-agree">
                    {{ trans('cookiebar::banner.agree') }}
                </button>
            </div>

            <button data-cookiebar="update-consent"
                class="cb-mt-2 cb-ml-8 cb-underline cb-text-xs js-cookiebar-dismiss">
                {{ trans('cookiebar::banner.dismiss') }}
            </button>
        </div>

    </div>
</div>
