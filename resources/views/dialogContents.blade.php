<div x-data="laravelCookiebar" x-init="init()" x-show="showDialog"
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
        var gtm_code = "{{ config('cookiebar.gtm_code', '') }}";
        var advanced_cookie_name = "{{ config('cookiebar.cookie_name', '') }}";
        var expirationInDays = {{ config('cookiebar.cookie_lifetime', '') }};
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
        function initDefaultConsent() {
            console.log('initDefaultConsent');

            // se non ho il cookie, nego tutti i consenti
            if (! cookieExists(advanced_cookie_name)) {
                gtag('consent', 'default', gtag_consent);
                setCookie(advanced_cookie_name, JSON.stringify(gtag_consent), expirationInDays)
                return;
            }

            // se ho cookie, aggiorno consenti
            var consents = getCookie(advanced_cookie_name);
            setCookie(advanced_cookie_name, JSON.stringify(consents), expirationInDays)
            gtag('consent', 'update', consents);
        }

        // load GTM scripts
        function loadGTM(gtm_code) {
            console.log('loadGTM');

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

        function setCookie(name, value, expirationInDays) {
            console.log('setCookie');
            var date = new Date();
            date.setTime(date.getTime() + (expirationInDays * 24 * 60 * 60 * 1000));
            document.cookie = name + '=' + value + ';expires=' + date.toUTCString()
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) === 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function cookieExists(name) {
            return (document.cookie.split('; ').indexOf(name + '=' + gtag_consent) !== -1);
        }

        // Alpine Object
        return {
            showDialog: true,
            showModal: false,
            init() {
                initDefaultConsent();
                loadGTM(gtm_code);
            },
            agree() {
                var consents = Object.values(gtag_consent).map(function(value) {
                     value = 'granted';
                     return value;
                });
                gtag('consent', 'update', consents);
                setCookie(advanced_cookie_name, JSON.stringify(consents), expirationInDays)
                this.showDialog = false;
            },
            dismiss() {
                console.log('dismiss')
            },
            manage() {
                console.log('manage')
            },

        }

    })()


</script>
