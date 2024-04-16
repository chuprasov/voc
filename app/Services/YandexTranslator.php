<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class YandexTranslator implements TranslatorContract
{
    protected const HOST = 'https://dictionary.yandex.net/api/v1/dicservice.json';

    public static function translate(string $sourceLang, string $targetLang, string $text)
    {
        try {
            $response = Http::get(self::HOST.'/lookup', [
                'key' => env('YANDEX_API_KEY', ''),
                'lang' => $sourceLang.'-'.$targetLang,
                'text' => $text,
                'ui' => 'en',
            ])->throw()->json();

            $sourceData = [];

            $remarks = [];

            $translations = [];

            if (isset($response['def']) && isset($response['def'][0])) {
                $sourceData = array_intersect_key($response['def'][0], [
                    'text' => '',
                    'pos' => '',
                    'gen' => '',
                ]);

                $remarks = [
                    'remarks' => self::processTranslation($sourceData, $sourceLang),
                ];

                $translations = array_map(
                    function ($tr) use ($targetLang) {
                        return self::processTranslation($tr, $targetLang);
                    },
                    $response['def'][0]['tr']
                );

                // $translations = array_column($response['def'][0]['tr'], 'text');
            }

            $translationResult = array_merge(
                $sourceData,
                $remarks,
                ['translations' => $translations]
            );

            return $translationResult;

        } catch (Exception $e) {
            return 'Error !!!';
        }
    }

    protected static function processTranslation(array $translation, string $lang)
    {
        $artD = [
            'm' => 'der ',
            'f' => 'die ',
            'n' => 'das ',
        ];

        $prefix = '';
        $postfix = '';

        if (isset($translation['gen'])) {
            if ($lang === 'de' && array_key_exists($translation['gen'], $artD)) {
                $prefix = $artD[$translation['gen']];
            }

            $postfix = ' ('.$translation['gen'].')';
        }

        return $prefix.$translation['text'].$postfix;
    }
}
