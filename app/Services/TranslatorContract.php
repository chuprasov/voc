<?php

namespace App\Services;

interface TranslatorContract
{
    public static function translate(string $sourceLang, string $targetLang, string $text);
}
