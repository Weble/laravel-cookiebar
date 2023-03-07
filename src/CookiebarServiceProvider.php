<?php

namespace Weble\Cookiebar;

use Illuminate\Contracts\View\View;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Support\Collection;
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
            ->hasViewComposer('cookiebar::default-consents', fn (View $view) => $view->with([
                'defaultConsents' => $this->defaultConsents(),
            ]))
            ->hasViewComposer('cookiebar::index', fn (View $view) => $view->with([
                'hasAlreadyConsented' => Cookie::has($this->cookieName()),
                'consents' => $this->consents(),
            ]));
    }

    public function packageBooted(): void
    {
        $this->disableCookieEncryptionForCookiebar();
    }

    private function defaultConsents(): Collection
    {
        $cookie = Cookie::get($this->cookieName());

        if (! $cookie) {
            return $this->getDefaultConsents();
        }

        $consents = json_decode($cookie, true);

        if (! $consents) {
            return $this->getDefaultConsents();
        }

        return collect($consents);
    }

    private function getDefaultConsents(): Collection
    {
        return $this->consents()->map(fn (array $item) => $item['value'] ?? 'denied');
    }

    private function consents(): Collection
    {
        return collect(config('cookiebar.gtag_consent', []))->except('required');
    }

    private function cookieName(): string
    {
        return config('cookiebar.cookie_name', '_cookieAdvancedAllowed');
    }

    private function disableCookieEncryptionForCookiebar(): void
    {
        $this->app->resolving(
            EncryptCookies::class,
            fn (EncryptCookies $encryptCookies) => $encryptCookies->disableFor($this->cookieName())
        );
    }
}
