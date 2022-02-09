<div class="fixed top-0 inset-x-0 px-4 pt-6 z-50 sm:px-0 sm:flex sm:items-top sm:justify-center ">
    <div class="fixed inset-0 transform transition-all">
        <div class="absolute inset-0 bg-blue-900 opacity-30"></div>
    </div>

    <div class="bg-white rounded overflow-hidden shadow-md transform transition-all sm:w-full sm:max-w-3xl">
        <div class="flex flex-col space-y-5">
            <div class="pt-10 px-10 flex-col space-y-5">
                <h1 class="font-bold text-xl text-primary">
                    {{ trans('cookiebar::modal.title') }}
                </h1>
                <p>
                    {{ trans('cookiebar::modal.description') }}
                </p>
            </div>
            <div class="flex flex-col divide-y px-10">
                @foreach($cookiebarConfig['gtag_consent'] as $consent)
                    @if($consent['enabled'])
                        <div class="py-5 flex justify-between items-center">
                            <div class="flex items-center space-x-3">
                                <h2>
                                    {{ trans('cookiebar::consent.'.$consent['title'].'.title') }}
                                </h2>
                                <span class="mt-1">
                                    <svg class="w-2" viewBox="0 0 14 8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-738.000000, -2577.000000)">
                                                <polygon fill="currentColor" fill-rule="nonzero" points="744.999998 2584.39102 745.591279 2583.87604 752 2578.38285 750.817439 2577 744.999998 2581.98776 739.182561 2577 738 2578.38285 744.408718 2583.87604"></polygon>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            <div>

                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="py-5 px-10">

            </div>
        </div>
    </div>
</div>
