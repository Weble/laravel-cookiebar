# Laravel cookie consent dialog

## Installazione

```shell
composer require weble/laravel-cookiebar
```

### Config

```shell
php artisan vendor:publish --provider="Weble\Cookiebar\CookiebarServiceProvider" --tag="cookiebar-config"
```

### Views

```shell
php artisan vendor:publish --provider="Weble\Cookiebar\CookiebarServiceProvider" --tag="cookiebar-view"
```

### Traduzioni

```shell
php artisan vendor:publish --provider="Spatie\CookieConsent\CookieConsentServiceProvider" --tag="cookiebar-translations"
```

## Utilizzo

Aggiunger Weble\Cookiebar\CookiebarMiddleware nel kernel:

```php
// app/Http/Kernel.php

class Kernel extends HttpKernel
{
    protected $middleware = [
    // ...
        \Weble\Cookiebar\CookiebarMiddleware::class,
    ];

    // ...
}
```

Viene aggiunto prima della chiusura del body ```cookiebar::index```

### Personalizzare UI

Modificare le views pubblicate ```resources/view/vendor/cookiebar/banner.blade.php```, ```resources/view/vendor/cookiebar/modal.blade.php``` con classi o stili.
