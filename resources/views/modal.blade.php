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
            <div class="cb-flex cb-flex-col cb-divide-y cb-px-10">
                @foreach($cookiebarConfig['gtag_consent'] as $consent)
                    @if($consent['enabled'])
                        <div class="cb-py-5 cb-flex cb-justify-between cb-items-center">
                            <div class="cb-flex cb-items-center cb-space-x-3">
                                <h2>
                                    {{ trans('cookiebar::consent.'.$consent['title'].'.title') }}
                                </h2>
                                <span class="cb-mt-1">
                                    <svg class="cb-w-2" viewBox="0 0 14 8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-738.000000, -2577.000000)">
                                                <polygon fill="currentColor" fill-rule="nonzero" points="744.999998 2584.39102 745.591279 2583.87604 752 2578.38285 750.817439 2577 744.999998 2581.98776 739.182561 2577 738 2578.38285 744.408718 2583.87604"></polygon>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            <div>
                                <div class="form-check">
                                    <input type="checkbox" value="1" id="{{$consent['title']}}" @if($consent['title'] === 'required') checked disabled @endif
                                        class="form-check-input cb-appearance-none cb-h-5 cb-w-5 cb-border cb-border-gray-300 cb-rounded-sm cb-bg-white checked:cb-bg-blue-600 checked:cb-border-blue-600 focus:cb-outline-none cb-transition cb-duration-200 cb-my-1 cb-align-top cb-bg-no-repeat cb-bg-center cb-bg-contain cb-float-left cb-cursor-pointer" >
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="cb-py-5 cb-px-10">

            </div>
        </div>
    </div>
</div>
