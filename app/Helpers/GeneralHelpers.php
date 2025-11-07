<?php

use App\Models\Translation\AppTranslation;

if (!function_exists('translator')) {
    /**
     * Use for translating stuff.
     *
     * @param string $value The word to be translated
     * @param string $lang Set the language to translate to
     * @return string
     */
    function translator(string $value, string|NULL $lang = NULL): string
    {
        $output = $value;

        if ($lang !== NULL) {
            $translation = AppTranslation::where('value', $value)->where('lang', $lang)->first();
            if ($translation !== NULL) $output = $translation->translation;
        }

        return $output;
    }
}
