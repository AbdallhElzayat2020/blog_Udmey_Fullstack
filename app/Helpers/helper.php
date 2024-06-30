<?php

use App\Models\Language;
use Illuminate\Support\Str;

/**
 * Helper Function for news tags
 *
 * Formats an array of tags into a comma-separated string.
 *
 * @param array $tags An array of tags
 * @return string A comma-separated string of tags
 * @example formatTags(['tag1', 'tag2', 'tag3']) 'tag1,tag2,tag3'
 */
function formatTags(array $tags): string
{
    return implode(',', $tags);
}

/**
 * Get Selected Language from Session
 *
 * Retrieves the selected language from the session. If no language is set, it defaults to the default language in the database.
 *
 * @return string The selected language code (e.g. 'en', 'fr', etc.)
 * @example getLanguage() 'en'
 */
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

            return 'en';
        }
    }
}

/**
 * Set LanguageCode in Session
 *
 * Sets the selected language in the session.
 *
 * @param string $code The language code (e.g. 'en', 'fr', etc.)
 * @return void
 * @example setLanguage('fr')
 */
function setLanguage(string $code): void
{
    session(['language' => $code]);
}

/**
 * Truncate Text limit for text
 *
 * Truncates a given text to a specified limit, appending an ellipsis if necessary.
 *
 * @param string $text The text to truncate
 * @param int $limit The maximum number of characters to display (default: 20)
 * @return string The truncated text
 * @example truncateText('This is a very long text', 10) 'This is a...'
 */
function truncateText(string $text, int $limit = 20): string
{
    return Str::limit($text, $limit, '...');
}

/**
 * Convert number to K or M format
 *
 * Converts a given number to a more readable format, using K for thousands and M for millions.
 *
 * @param int $number The number to convert
 * @return string The converted number
 * @example convertTokFormat(1234) '1.2K'
 * @example convertTokFormat(1234567) '1.2M'
 */
function convertTokFormat(int $number): string
{
    if ($number < 1000) {
        return $number;
    } elseif ($number < 1000000) {
        return round($number / 1000, 1) . 'K';
    } else {
        return round($number / 1000000, 1) . 'M';
    }
}
