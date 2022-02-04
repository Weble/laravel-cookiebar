@if($cookiebarConfig['enabled'] && ! $alreadyConsentedWithCookies)

    @include('cookiebar::dialogContents')

    <script>

        window.dataLayer = window.dataLayer || [];

        if (typeof gtag === 'undefined') {

            function gtag() {
                dataLayer.push(arguments);
            }

            window.gtag = window.gtag || gtag;
        }

        const gtag_consent = {
            ad_storage: 'denied',
            analytics_storage: 'denied',
            functional_storage: 'denied',
            personalization_storage: 'denied',
            security_storage: 'denied'
        };

        window.laravelCookieConsent = (function (gtag_consent) {

            const COOKIE_VALUE = JSON.stringify(gtag_consent);
            const COOKIE_DOMAIN = '{{ config('session.domain') ?? request()->getHost() }}';

            function consentWithCookies() {
                setCookie('{{ $cookiebarConfig['cookie_name'] }}', COOKIE_VALUE, {{ $cookiebarConfig['cookie_lifetime'] }});
                hideCookieDialog();
            }

            function cookieExists(name) {
                return (document.cookie.split('; ').indexOf(name + '=' + COOKIE_VALUE) !== -1);
            }

            function hideCookieDialog() {
                const dialogs = document.getElementsByClassName('js-cookiebar');

                for (let i = 0; i < dialogs.length; ++i) {
                    dialogs[i].style.display = 'none';
                }
            }

            function setCookie(name, value, expirationInDays) {
                const date = new Date();
                date.setTime(date.getTime() + (expirationInDays * 24 * 60 * 60 * 1000));
                document.cookie = name + '=' + value
                    + ';expires=' + date.toUTCString()
                    + ';domain=' + COOKIE_DOMAIN
                    + ';path=/{{ config('session.secure') ? ';secure' : null }}'
                    + '{{ config('session.same_site') ? ';samesite='.config('session.same_site') : null }}';
            }

            if (cookieExists('{{ $cookiebarConfig['cookie_name'] }}')) {
                hideCookieDialog();
            }

            const buttons = document.getElementsByClassName('js-cookiebar-agree');

            for (let i = 0; i < buttons.length; ++i) {
                buttons[i].addEventListener('click', consentWithCookies);
            }

            return {
                consentWithCookies: consentWithCookies,
                hideCookieDialog: hideCookieDialog
            };
        })();

        window.onload = function() {
            const gtm_code  = {{ $cookiebarConfig['gtm_code'] }};

            if (!gtm_code) {
                return;
            }

            (function (w, d, s, l, i) {
                w[l] = w[l] || [];w[l].push({'gtm.start':
                        new Date().getTime(), event: 'gtm.js'});const f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';j.async = true;j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', gtm_code);
        };
    </script>

@endif
