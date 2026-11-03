<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use Tests\TestCase;

class LanguageSwitcherTest extends TestCase
{
    public function test_up_to_four_languages_are_links_and_preserve_path_and_query(): void
    {
        config(['app.available_locales' => ['fr', 'en', 'de', 'es']]);
        app()->setLocale('en');
        $this->app->instance('request', Request::create('/en/clients?page=2'));
        $html = view('layouts.language-switcher')->render();
        $this->assertStringNotContainsString('<select', $html);
        $this->assertSame(4, substr_count($html, '<a '));
        $this->assertStringContainsString('/fr/clients?page=2', $html);
        $this->assertSame(1, substr_count($html, 'aria-current="true"'));
    }

    public function test_more_than_four_languages_use_a_dropdown(): void
    {
        config(['app.available_locales' => ['fr', 'en', 'de', 'es', 'it']]);
        app()->setLocale('it');
        $this->app->instance('request', Request::create('/it/clients'));
        $html = view('layouts.language-switcher')->render();
        $this->assertStringContainsString('<select', $html);
        $this->assertSame(5, substr_count($html, '<option'));
        $this->assertSame(1, substr_count($html, 'selected'));
        $this->assertStringContainsString('IT', $html);
    }
}
