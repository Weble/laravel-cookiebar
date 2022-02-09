<?php

namespace Weble\Cookiebar;

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
            ->hasAssets()
            ->hasViews()
            ->hasTranslations()
            ->hasViewComposer('cookiebar::index', function (View $view) {
                $cookiebarConfig = config('cookiebar');
                $alreadyConsentedWithCookies = Cookie::has($cookiebarConfig['cookie_name']);
                $consentsJSON = $this->consentToJSON($cookiebarConfig['gtag_consent']);
                $view->with(compact('alreadyConsentedWithCookies', 'cookiebarConfig', 'consentsJSON'));
            });
    }

    public function packageBooted(): void
    {
        $this->app->resolving(EncryptCookies::class, function (EncryptCookies $encryptCookies) {
            $encryptCookies->disableFor(config('cookiebar.cookie_name'));
        });
    }

    protected function consentToJSON(array $consents)
    {
        return collect($consents)
            ->skip(1)
            ->mapWithKeys(function ($item, $key) {
                return [$key => $item['value']];
            })
            ->toJson(JSON_PRETTY_PRINT);
    }
}
