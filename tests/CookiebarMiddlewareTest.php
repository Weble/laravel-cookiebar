<?php

namespace Weble\Cookiebar\Test;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Weble\Cookiebar\CookiebarMiddleware;

class CookiebarMiddlewareTest extends TestCase
{
    /** @test */
    public function it_injects_the_if_a_closing_body_tag_is_found()
    {
        $request = new Request();

        $middleware = new CookiebarMiddleware();

        $result = $middleware->handle($request, function ($request) {
            return (new Response())->setContent('<html><head></head><body></body></html>');
        });

        $content = $result->getContent();

        $this->assertStringContainsString('<html><head></head><body>', $content);
        $this->assertStringContainsString('cookiebar', $content);
        $this->assertStringContainsString('configure', $content);
        $this->assertStringContainsString('init', $content);
        $this->assertStringContainsString('setupTemplate', $content);
        $this->assertStringContainsString('loadGTM', $content);
        $this->assertStringContainsString('</body></html>', $content);
    }

    /** @test */
    public function it_does_not_alter_content_that_does_not_contain_a_body_tag()
    {
        $request = new Request();

        $middleware = new CookiebarMiddleware();

        $result = $middleware->handle($request, function ($request) {
            return  (new Response())->setContent('<html></html>');
            ;
        });

        $content = $result->getContent();

        $this->assertEquals('<html></html>', $content);
    }
}
