<div class="fixed top-0 inset-x-0 px-4 pt-6 z-50 sm:px-0 sm:flex sm:items-top sm:justify-center ">
    <div class="fixed inset-0 transform transition-all">
        <div class="absolute inset-0 bg-blue-900 opacity-30"></div>
    </div>

    <div class="bg-white rounded overflow-hidden shadow-md transform transition-all sm:w-full sm:max-w-3xl p-10">
        <div class="flex flex-col space-y-5">
            <div>
                <h3 class="font-bold text-xl text-primary">
                    {{ trans('cookiebar::modal.title') }}
                </h3>
            </div>
            <div >
                <p>
                    {{ trans('cookiebar::modal.description') }}
                </p>
            </div>
        </div>
    </div>
</div>
