<?php

namespace Weble\CookieConsent;

use Illuminate\Contracts\View\View;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Support\Facades\Cookie;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CookiebarServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-cookiebar')
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations()
            ->hasViewComposer('cookiebar::index', function (View $view) {
                $cookiebarConfig = config('cookiebar');

                $alreadyConsentedWithCookies = Cookie::has($cookiebarConfig['cookie_name']);

                $view->with(compact('alreadyConsentedWithCookies', 'cookiebarConfig'));
            });
    }

    public function packageBooted(): void
    {
        $this->app->resolving(EncryptCookies::class, function (EncryptCookies $encryptCookies) {
            $encryptCookies->disableFor(config('cookiebar.cookie_name'));
        });
    }
}
