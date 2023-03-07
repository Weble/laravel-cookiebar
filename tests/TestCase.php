<?php

namespace Weble\Cookiebar\Test;

use Illuminate\Support\Str;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Spatie\GoogleTagManager\GoogleTagManagerServiceProvider;
use Weble\Cookiebar\CookiebarServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            GoogleTagManagerServiceProvider::class,
            CookiebarServiceProvider::class,
        ];
    }

    protected function defineRoutes($router)
    {
        $router->view('/', 'layout');
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('laravel-blade-javascript.namespace', 'js');
        $app['config']->set('view.paths', [__DIR__.'/stubs/views']);
    }

    public function assertTranslationExists(string $key)
    {
        $this->assertTrue(trans($key) != $key, "Failed to assert that a translation exists for key `{$key}`");
    }

    protected function assertConsentDialogDisplayed(string $html)
    {
        $this->assertTrue($this->isConsentDialogDisplayed($html), 'Failed to assert that the consent dialog is displayed.');
    }

    protected function assertConsentDialogIsNotDisplayed(string $html)
    {
        $this->assertFalse($this->isConsentDialogDisplayed($html), 'Failed to assert that the consent dialog is not being displayed.');
    }

    protected function assertDefaultConsentsDisplayed(string $html)
    {
        $this->assertTrue(
            condition: $this->isDefaultConsentsDisplayed($html),
            message: 'Failed to assert that the default consents are displayed.'
        );
    }

    protected function assertDefaultConsentsAreNotDisplayed(string $html)
    {
        $this->assertFalse(
            condition: $this->isDefaultConsentsDisplayed($html),
            message: 'Failed to assert that the default consents is not being displayed.'
        );
    }

    protected function assertDefaultConsentsAreGranted(string $html)
    {
        $this->assertTrue(
            condition: $this->hasGrantedString($html),
            message: 'Failed to assert that the cookie consents are displayed.'
        );
    }

    protected function assertDefaultConsentsAreNotGranted(string $html)
    {
        $this->assertFalse(
            condition: $this->hasGrantedString($html),
            message: 'Failed to assert that the default consents are displayed.'
        );
    }

    protected function isConsentDialogDisplayed(string $html): bool
    {
        return Str::contains($html, [
            trans('cookiebar::banner.message'),
        ]);
    }

    protected function isDefaultConsentsDisplayed(string $html): bool
    {
        return Str::contains($html, ['consent', 'default']);
    }

    protected function hasGrantedString(string $html): bool
    {
        return Str::contains($html, ['granted']);
    }
}
