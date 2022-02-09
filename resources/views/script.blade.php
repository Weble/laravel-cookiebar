<script src="/vendor/cookiebar/cookie.js" defer="defer" ></script>
<script>
    window.addEventListener('load', (event) => {
        cookiebar
            .configure({
                gtm_code: "{{ $cookiebarConfig['gtm_code']  }}",
                advanced_cookie_name: "{{ $cookiebarConfig['cookie_name'] }}",
                expirationInDays: {{ $cookiebarConfig['cookie_lifetime'] }},
                gtag_consent: {!! $consentsJSON !!}
            })
            .init()
            .setupTemplate()
            .loadGTM()
    });
</script>

