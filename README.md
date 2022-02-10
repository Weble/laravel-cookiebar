# Laravel Cookies Consent Management with GTM ConsentMode

Laravel package for the new EU Cookie LAW. Provides a nice toolbar with a modal to select which consent

## Installation

```shell
composer require weble/laravel-cookiebar
```

## Publish Assets

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

### Translations

```shell
php artisan vendor:publish --provider="Weble\Cookiebar\CookiebarServiceProvider" --tag="cookiebar-translations"
```

## Usage

Add `Weble\Cookiebar\CookiebarMiddleware` in the `App\Http\Kernel`, to the route group you want to have the cookiebar. Usually it's the `web` group, or the general middleware list.

Set `GTM_CODE` variable to your `.env` file with your Google Tag Manager code.

## Customizations

You can publish the views, assets and translations, and then edit the files in `resources/view/vendor/cookiebar/banner.blade.php` and `resources/view/vendor/cookiebar/modal.blade.php`
