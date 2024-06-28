<?php

/* Helper Function for news tags */

use App\Models\Language;

function formatTags(array $tags): string
{
    return implode(',', $tags);
    return '';
}

/*  get Selected Language from Session */

function getLanguage(): string
{
    if (session()->has('language')) {
        return session('language');
    } else {
        try {
            $language = Language::where('default', 1)->first();

            setLanguage($language->lang);

            return $language->lang;
        } catch (Throwable $th) {
            setLanguage('en');

            return $language->lang;
        }
    }
}

/*  Set LanguageCode in Session */
function setLanguage(string $code): void
{
    session(['language' => $code]);

}
