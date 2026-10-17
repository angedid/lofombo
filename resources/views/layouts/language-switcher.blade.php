@php
    $locales = config('app.available_locales', []);
    $currentLocale = app()->getLocale();
    $languageNames = ['fr' => 'Français', 'en' => 'English'];
    $languageUrl = function ($locale) {
        $segments = request()->segments();
        if (in_array($segments[0] ?? '', config('app.available_locales', []), true)) {
            array_shift($segments);
        }
        $path = url(implode('/', array_merge([$locale], $segments)));
        return $path . (request()->getQueryString() ? '?' . request()->getQueryString() : '');
    };
@endphp
@if(count($locales) > 4)
    <select class="language-select" aria-label="{{ __('Langue') }}"
            onchange="window.location.assign(this.value)">
        @foreach($locales as $locale)
            <option value="{{ $languageUrl($locale) }}" @selected($locale === $currentLocale)>
                {{ $languageNames[$locale] ?? strtoupper($locale) }}
            </option>
        @endforeach
    </select>
@else
    <nav class="language-switch" aria-label="{{ __('Langue') }}">
        @foreach($locales as $locale)
            <a href="{{ $languageUrl($locale) }}" lang="{{ $locale }}"
               @if($locale === $currentLocale) aria-current="true" @endif>
                {{ strtoupper($locale) }}
            </a>
        @endforeach
    </nav>
@endif
