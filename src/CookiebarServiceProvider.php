<?php

namespace Weble\Cookiebar;

use Illuminate\Contracts\View\View;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Spatie\GoogleTagManager\DataLayer;
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
        Blade::directive('gtag', function ($expression) {
            return <<<EOT
                <?php
                    if ({$expression} instanceOf \Spatie\GoogleTagManager\DataLayer) {
                         if (count(({$expression})->toArray()) === 3) {
                            echo "gtag('".({$expression})->toArray()[0]."', '".({$expression})->toArray()[1]."', ".json_encode(({$expression})->toArray()[2]).")";
                        }

                        if (count(({$expression})->toArray()) === 2) {
                            echo "gtag(({$expression})->toJson());";
                        }
                    }
                ?>
            EOT;
        });

        $this->disableCookieEncryptionForCookiebar();
        $this->registerGoogleTagManagerConsentFacade();

        $this->initConsents();
    }

    private function initConsents(): void
    {
        $cookie = Cookie::get($this->cookieName());

        if (! $cookie) {
            $this->setDefaultConsents();

            return;
        }

        $consents = json_decode($cookie, true);

        if (! $consents) {
            $this->setDefaultConsents();

            return;
        }

        $this->setDefaultConsents($consents);
    }

    private function consents(): Collection
    {
        return collect(config('cookiebar.gtag_consent', []))
            ->except('required');
    }

    private function setDefaultConsents(?array $consents = null): void
    {
        $consents = $consents ?? $this
            ->consents()
            ->map(fn (array $item) => $item['value'] ?? 'denied')
            ->toArray();

        GoogleTagManagerFacade::defaultConsents($consents);
//        GoogleTagManagerFacade::push('event', 'gtm.init_consent');
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
//        GoogleTagManager::macro('updateConsents', fn (array $consents) => GoogleTagManagerFacade::push(['consent', 'update', $consents]));

    }
}
