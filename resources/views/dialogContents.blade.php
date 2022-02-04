<div x-data="laravelCookiebar" x-init="init()"
    class="fixed bottom-0 w-full py-4 text-white bg-black shadow-top js-cookiebar cookiebar z-50">
    <div class="container mx-auto flex flex-col items-center justify-center text-center lg:text-left space-y-4">

        <span class="cookiebar__message">
            {!! trans('cookiebar::texts.message') !!}
        </span>

        <div class="flex flex-col items-center justify-center space-y-4">
            <div class="flex justify-center items-center space-x-4">
                <button @click="manage()"
                    class="ml-8 bg-white bg-opacity-0 text-white border border-white hover:bg-opacity-25 font-bold text-sm uppercase px-3 py-2 lg:px-4 lg:py-2 rounded-full flex flex-row items-center justify-center js-cookiebar-manage cookiebar__manage">
                    {{ trans('cookiebar::texts.manage') }}
                </button>
                <button @click="agree()"
                    class="ml-8 bg-white bg-opacity-100 hover:bg-black text-black hover:text-white border border-black hover:border-white font-bold text-sm uppercase px-3 py-2 lg:px-4 lg:py-2 rounded-full flex flex-row items-center justify-center js-cookiebar-agree cookiebar__agree">
                    {{ trans('cookiebar::texts.agree') }}
                </button>
            </div>

            <button @click="dismiss()"
                class="mt-2 ml-8 underline text-xs js-cookiebar-dismiss cookiebar__dismiss">
                {{ trans('cookiebar::texts.dismiss') }}
            </button>
        </div>

    </div>
</div>

<script>

    laravelCookiebar = (function () {

        // Settings
        var gtm_code = "{{ config('cookiebar.gtm_code', '') }}"
        var advanced_cookie_name = "{{ config('cookiebar.cookie_name', '') }}"
        var gtag_consent = {
            ad_storage: 'denied',
            analytics_storage: 'denied',
            functional_storage: 'denied',
            personalization_storage: 'denied',
            security_storage: 'denied'
        };

        // Data Layer
        window.dataLayer = window.dataLayer || [];
        if (typeof gtag === 'undefined') {
            function gtag() {
                dataLayer.push(arguments);
            }
            window.gtag = window.gtag || gtag;
        }

        // Default Consent
        var initDefaultConsent = function() {
            console.log('initDefaultConsent');
            gtag('consent', 'default', gtag_consent);
        }

        var loadGTM = function (gtm_code) {
            if (!gtm_code) {
                return;
            }

            (function (w, d, s, l, i) {
                w[l] = w[l] || [];w[l].push({'gtm.start':
                        new Date().getTime(), event: 'gtm.js'});const f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l !== 'dataLayer' ? '&l=' + l : '';j.async = true;j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', gtm_code);
        }

        // Alpine Object
        return {
            init: function() {
                initDefaultConsent();
                loadGTM(gtm_code);
            },
            agree: function () {
                console.log('agree')
            },
            dismiss: function () {
                console.log('dismiss')
            },
            manage: function () {
                console.log('manage')
            }
        }


    })()


</script>
