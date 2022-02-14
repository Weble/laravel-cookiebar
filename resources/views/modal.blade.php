<div id="cookiebar-modal" style="display: none;">
    <div class="fixed inset-0 transform transition-all z-50">
        <div class="absolute inset-0 bg-blue-900 opacity-30"></div>
    </div>
    <div class="fixed top-0 inset-x-0 px-4 pt-6 z-50 sm:px-0 sm:flex sm:items-top sm:justify-center ">
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
                <div class="flex flex-col divide-y px-10 cd-divide-gray-300">
                    @foreach($consents as $consent)
                        @if($consent['enabled'])
                            <div class="py-5" >
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-3 js-toggable-button">
                                        <h2>
                                            {{ trans('cookiebar::consent.'.$consent['title'].'.title') }}
                                        </h2>
                                    </div>
                                    <div>
                                        <div class="form-check">
                                            <input type="checkbox" value="1" id="{{$consent['title']}}" @if($consent['title'] === 'required') checked disabled @endif
                                                class="form-check-input appearance-none h-5 w-5 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 my-1 align-top bg-no-repeat bg-center bg-contain float-left cursor-pointer" >
                                        </div>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-500" >
                                    <p class="pr-14 pt-2">
                                        {{ trans('cookiebar::consent.'.$consent['title'].'.description') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="p-10 flex justify-end items-center space-x-3">
                    <button type="button" class="px-6 py-2 hover:underline" data-cookiebar="modal-hide">
                        {{ trans('cookiebar::modal.cancel') }}
                    </button>
                    <button
                        type="button"
                        data-cookiebar="update-consent"
                        class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 js-cookiebar-custom"
                    >
                        {{ trans('cookiebar::modal.save') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
