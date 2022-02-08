<script src="/vendor/cookiebar/cookie.js" defer="defer" ></script>
<script>
    window.addEventListener('load', (event) => {
        cookiebar
            .configure({
                gtm_code: "{{ $cookiebarConfig['gtm_code']  }}",
                advanced_cookie_name: "{{ $cookiebarConfig['cookie_name'] }}",
                expirationInDays: {{ $cookiebarConfig['cookie_lifetime'] }},
                // TODO: make configurable
                gtag_consent: {
                    ad_storage: 'denied',
                    analytics_storage: 'denied',
                    functional_storage: 'denied',
                    personalization_storage: 'denied',
                    security_storage: 'denied'
                }
            })
            .init()
    });
</script>

