@if($cookiebarConfig['enabled'] && ! $alreadyConsentedWithCookies)
    @include('cookiebar::dialogContents')
@endif
