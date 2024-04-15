<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use App\Services\TranslatorContract;

class DeepLTranslator implements TranslatorContract
{
    protected const HOST = 'https://api-free.deepl.com/v2';

    public static function translate(string $sourceLang, string $targetLang, string $text)
    {
        try {
            $response = Http::asForm()->withHeaders([
                'Authorization' => 'DeepL-Auth-Key ' . env('DEEPL_API_KEY'),
                'Content-Type' => 'application/json'
            ])->post(self::HOST . '/translate', [
                'source_lang' => $sourceLang,
                'target_lang' => $targetLang,
                'text' => $text,
            ])->throw()->json();

            $sourceData = [
                'text' => $text,
                'pos' => '',
                'gen' => '',
            ];

            $translations = [];

            if (isset($response['translations']) && isset($response['translations'][0])) {
                $translations[] = $response['translations'][0]['text'];
            }

            $translationResult = array_merge(
                $sourceData,
                ['translations' => $translations]
            );

            return $translationResult;
        } catch (Exception $e) {
            return 'Error !!!';
        }
    }
}
