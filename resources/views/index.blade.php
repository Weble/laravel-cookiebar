@if($cookiebarConfig['enabled'] && ! $alreadyConsentedWithCookies)
    @include('cookiebar::banner')
    @include('cookiebar::modal')
@endif
