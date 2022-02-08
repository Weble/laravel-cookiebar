@if($cookiebarConfig['enabled'])
    @include('cookiebar::script')
@endif

@if($cookiebarConfig['enabled'] && ! $alreadyConsentedWithCookies)
    @include('cookiebar::banner')
    @include('cookiebar::modal')
@endif
