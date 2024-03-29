<?php

namespace Weble\Cookiebar\Test;

class CookiebarTest extends TestCase
{
    /** @test */
    public function it_provides_translations()
    {
        $this->assertTranslationExists('cookiebar::banner.message');
        $this->assertTranslationExists('cookiebar::banner.agree');
        $this->assertTranslationExists('cookiebar::banner.dismiss');
        $this->assertTranslationExists('cookiebar::banner.manage');
    }

    /** @test */
    public function it_can_display_a_cookie_consent_view()
    {
        $html = view('layout')->render();

        $this->assertConsentDialogDisplayed($html);
    }

    /** @test */
    public function it_will_not_show_the_cookie_consent_view_when_the_package_is_disabled()
    {
        $this->app['config']->set('cookiebar.enabled', false);

        $html = view('layout')->render();

        $this->assertConsentDialogIsNotDisplayed($html);
    }

    /** @test */
    public function it_will_not_show_the_cookie_consent_view_when_the_user_has_already_consented()
    {
        request()->cookies->set(config('cookiebar.cookie_name'), cookie(config('cookiebar.cookie_name'), 1));

        $html = view('layout')->render();

        $this->assertConsentDialogIsNotDisplayed($html);
    }

    /** @test */
    public function it_contains_the_necessary_css_classes_for_javascript_functionality()
    {
        $html = view('layout')
            ->with([
                'cookiebarConfig' => [
                    'gtag_consent' => [],
                ],
            ])
            ->render();

        $this->assertStringContainsString('js-cookiebar', $html);
        $this->assertStringContainsString('js-cookiebar-agree', $html);
        $this->assertStringContainsString('js-cookiebar-dismiss', $html);
        $this->assertStringContainsString('js-cookiebar-manage', $html);
        $this->assertStringContainsString('js-cookiebar-custom', $html);
        $this->assertStringContainsString('data-cookiebar="update-consent"', $html);
        $this->assertStringContainsString('data-cookiebar="modal-show"', $html);
        $this->assertStringContainsString('data-cookiebar="modal-hide"', $html);
    }

    /** @test */
    public function it_will_show_the_cookie_consents()
    {
        $this->app['config']->set('cookiebar.enabled', true);

        $html = view('layout')->render();

        $this->assertDefaultConsentsDisplayed($html);
    }

    /** @test */
    public function it_will_not_show_the_cookie_consents()
    {
        $this->app['config']->set('cookiebar.enabled', false);

        $html = view('layout')->render();

        $this->assertDefaultConsentsAreNotDisplayed($html);
    }

    /** @test */
    public function it_will_show_the_cookie_consents_from_cookie()
    {
        $this->app['config']->set('cookiebar.enabled', true);

        $consentsGranted = collect(config('cookiebar.gtag_consent', []))
            ->except('required')
            ->map(fn () => 'granted');

        request()
            ->cookies
            ->set(config('cookiebar.cookie_name'), json_encode($consentsGranted, true));

        $html = view('layout')->render();

        $this->assertDefaultConsentsAreGranted($html);
    }

    /** @test */
    public function it_will_show_the_default_cookie_consents()
    {
        $this->app['config']->set('cookiebar.enabled', true);

        $html = view('layout')->render();

        $this->assertDefaultConsentsAreNotGranted($html);
    }
}
