<?php

namespace Weble\Cookiebar;

use Illuminate\Contracts\View\View;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Spatie\GoogleTagManager\GoogleTagManager;
use Spatie\GoogleTagManager\GoogleTagManagerFacade;
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
            ->hasViewComposer('cookiebar::index', fn (View $view) => $view->with([
                'hasAlreadyConsented' => Cookie::has($this->cookieName()),
                'consents' => $this->consents(),
            ]));
    }

    public function packageBooted(): void
    {
        $this->disableCookieEncryptionForCookiebar();
        $this->registerGoogleTagManagerConsentFacade();

        $this->setDefaultConsents();
        $this->initConsents();
    }

    private function initConsents(): void
    {
        $cookie = Cookie::get($this->cookieName());
        if (! $cookie) {
            return;
        }

        $consents = json_decode($cookie, true);
        if (! $consents) {
            return;
        }

        GoogleTagManagerFacade::updateConsents($consents);
    }

    private function consents(): Collection
    {
        return collect(config('cookiebar.gtag_consent', []))
            ->except('required');
    }

    private function setDefaultConsents(): void
    {
        $consents = $this
            ->consents()
            ->map(fn (array $item) => $item['value'] ?? 'denied');

        GoogleTagManagerFacade::defaultConsents($consents->toArray());
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

    private function registerGoogleTagManagerConsentFacade()
    {
        GoogleTagManager::macro('defaultConsents', fn (array $consents) => GoogleTagManagerFacade::push(['consent', 'default', $consents]));
        GoogleTagManager::macro('updateConsents', fn (array $consents) => GoogleTagManagerFacade::push(['consent', 'update', $consents, ['event' => 'cookie_advanced_consent_updated'], [ ['event' => 'gtm.init_consent']]]));
    }
}
