@if(config('cookiebar.enabled'))
    @if (!$hasAlreadyConsented)
        @include('cookiebar::banner')
    @endif

    @include('cookiebar::modal')
@endif
