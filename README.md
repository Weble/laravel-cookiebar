# Laravel cookie consent dialog

## Installazione

```shell
composer require weble/laravel-cookiebar
```

### Config

```shell
php artisan vendor:publish --provider="Weble\Cookiebar\CookiebarServiceProvider" --tag="cookiebar-config"
```

### Assets

```shell
php artisan vendor:publish --provider="Weble\Cookiebar\CookiebarServiceProvider" --tag="cookiebar-assets"
```

### Views

```shell
php artisan vendor:publish --provider="Weble\Cookiebar\CookiebarServiceProvider" --tag="cookiebar-views"
```

### Traduzioni

```shell
php artisan vendor:publish --provider="Weble\Cookiebar\CookiebarServiceProvider" --tag="cookiebar-translations"
```

## Utilizzo

- Aggiunger Weble\Cookiebar\CookiebarMiddleware nel kernel:

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


- Aggiungere ```GTM_CODE=``` nell'.env

### Personalizzare UI

Modificare le views pubblicate in ```resources/view/vendor/cookiebar/banner.blade.php```, ```resources/view/vendor/cookiebar/modal.blade.php```
