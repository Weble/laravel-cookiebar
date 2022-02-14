<div id="cookiebar-modal" style="display: none;">
    <div class="cb-fixed cb-inset-0 cb-transform cb-transition-all cb-z-50">
        <div class="cb-absolute cb-inset-0 cb-bg-blue-900 cb-opacity-30"></div>
    </div>
    <div class="cb-fixed cb-top-0 cb-inset-x-0 cb-px-4 cb-pt-6 cb-z-50 cb-sm:px-0 sm:cb-flex sm:cb-items-top sm:cb-justify-center ">
        <div class="cb-bg-white cb-rounded cb-overflow-hidden cb-shadow-md cb-transform cb-transition-all sm:cb-w-full sm:cb-max-w-3xl">
            <div class="cb-flex cb-flex-col cb-space-y-5">
                <div class="cb-pt-10 cb-px-10 cb-flex-col cb-space-y-5">
                    <h1 class="cb-font-bold cb-text-xl cb-text-primary">
                        {{ trans('cookiebar::modal.title') }}
                    </h1>
                    <p>
                        {{ trans('cookiebar::modal.description') }}
                    </p>
                </div>
                <div class="cb-flex cb-flex-col cb-divide-y cb-px-10 cd-divide-gray-300">
                    @foreach($consents as $consent)
                        @if($consent['enabled'])
                            <div class="cb-py-5" >
                                <div class="cb-flex cb-justify-between cb-items-center">
                                    <div class="cb-flex cb-items-center cb-space-x-3 js-toggable-button">
                                        <h2>
                                            {{ trans('cookiebar::consent.'.$consent['title'].'.title') }}
                                        </h2>
                                    </div>
                                    <div>
                                        <div class="form-check">
                                            <input type="checkbox" value="1" id="{{$consent['title']}}" @if($consent['title'] === 'required') checked disabled @endif
                                                class="form-check-input cb-appearance-none cb-h-5 cb-w-5 cb-border cb-border-gray-300 cb-rounded-sm cb-bg-white checked:cb-bg-blue-600 checked:cb-border-blue-600 focus:cb-outline-none cb-transition cb-duration-200 cb-my-1 cb-align-top cb-bg-no-repeat cb-bg-center cb-bg-contain cb-float-left cb-cursor-pointer" >
                                        </div>
                                    </div>
                                </div>
                                <div class="cb-text-sm cb-text-gray-500" >
                                    <p class="cb-pr-14 cb-pt-2">
                                        {{ trans('cookiebar::consent.'.$consent['title'].'.description') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="cb-p-10 cb-flex cb-justify-end cb-items-center cb-space-x-3">
                    <button type="button" class="cb-px-6 cb-py-2 hover:underline" data-cookiebar="modal-hide">
                        {{ trans('cookiebar::modal.cancel') }}
                    </button>
                    <button
                        type="button"
                        data-cookiebar="update-consent"
                        class="cb-px-6 cb-py-2 cb-bg-blue-600 cb-text-white cb-rounded hover:cb-bg-blue-700 js-cookiebar-custom"
                    >
                        {{ trans('cookiebar::modal.save') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
