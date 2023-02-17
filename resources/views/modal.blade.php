<div id="cookiebar-modal" style="display: none;">
    <div class="fixed inset-0 transform transition-all z-50">
        <div class="absolute inset-0 bg-cookiebar-modal-drop opacity-30"></div>
    </div>
    <div class="fixed top-0 inset-x-0 px-4 pt-6 z-50 sm:px-0 sm:flex sm:items-top sm:justify-center ">
        <div class="bg-white rounded overflow-hidden shadow-md transform transition-all sm:w-full sm:max-w-3xl">
            <div class="flex flex-col space-y-5">
                <div class="pt-10 px-10 flex-col space-y-5">
                    <h1 class="font-bold text-xl text-cookiebar-modal-primary">
                        {{ trans('cookiebar::modal.title') }}
                    </h1>
                    <p>
                        {{ trans('cookiebar::modal.description') }}
                    </p>
                </div>
                <div class="flex flex-col divide-y px-10 cd-divide-cookiebar-modal-border text-cookiebar-modal-secondary">
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
                                        <input
                                            type="checkbox"
                                            value="1"
                                            id="{{$consent['title']}}"
                                            @if($consent['title'] === 'required') checked disabled @endif
                                            class="cookiebar-checkbox border border-black rounded"
                                        >
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
                    <button type="button" class="px-6 py-2 hover:underline text-cookiebar-modal-cancel-secondary" data-cookiebar="modal-hide">
                        {{ trans('cookiebar::modal.cancel') }}
                    </button>
                    <button
                        type="button"
                        data-cookiebar="update-consent"
                        class="px-6 py-2 bg-cookiebar-modal-button-save-primary text-cookiebar-modal-button-save-secondary rounded hover:bg-cookiebar-modal-button-save-hover js-cookiebar-custom"
                    >
                        {{ trans('cookiebar::modal.save') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@once
    <style>
        .cookiebar-checkbox {
            appearance: none;
            background-color: #fff;
            margin: 0;
            font: inherit;
            color: currentColor;
            width: 1.4em;
            height: 1.4em;
            transform: translateY(-0.075em);
            display: grid;
            place-content: center;
        }

        .cookiebar-checkbox::before {
            content: "";
            width: 0.8em;
            height: 0.8em;
            transform: scale(0);
            transition: 120ms transform ease-in-out;
            box-shadow: inset 1em 1em;
            transform-origin: center center;
            clip-path: polygon(14% 44%, 0 65%, 50% 100%, 100% 16%, 80% 0%, 43% 62%);
        }

        .cookiebar-checkbox:checked::before {
            transform: scale(1);
        }
    </style>
@endonce
