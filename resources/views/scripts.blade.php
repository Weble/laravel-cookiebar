<script src="{{ asset('vendor/cookiebar/cookie.js') }}" defer="defer" ></script>
<script>
    window.addEventListener('load', () => {
        window.gtmCookieBar
            .configure({
                cookieName: "{{ config('cookiebar.cookie_name', '_cookieAdvancedAllowed') }}",
                expirationInDays: {{ (int) config('cookiebar.cookie_lifetime', 365) }},
                gtag_consent: {!! $consents->toJson(JSON_PRETTY_PRINT); !!}
            })
            .init()
            .setupTemplate()
    });
</script>
