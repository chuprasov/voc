<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use App\Services\TranslatorContract;

class YandexTranslator implements TranslatorContract
{
    protected const HOST = 'https://dictionary.yandex.net/api/v1/dicservice.json';

    public static function translate(string $sourceLang, string $targetLang, string $text)
    {
        try {
            $response = Http::get(self::HOST . '/lookup', [
                'key' => env('YANDEX_API_KEY', ''),
                'lang' => $sourceLang . '-' . $targetLang,
                'text' => $text,
                'ui' => 'en',
            ])->throw()->json();

            $sourceData = [];
            $translations = [];

            if (isset($response['def']) && isset($response['def'][0])) {
                $sourceData = array_intersect_key($response['def'][0], [
                    'text' => '',
                    'pos' => '',
                    'gen' => ''
                ]);

                $translations = array_map(
                    function ($tr) use ($targetLang) {
                        $artD = [
                            'm' => 'der ',
                            'f' => 'die ',
                            'n' => 'das ',
                        ];

                        $prefix = '';
                        $postfix = '';

                        if (isset($tr['gen'])) {
                            if ($targetLang === 'de') {
                                $prefix = $artD[$tr['gen']];
                            };

                            $postfix = ' (' . $tr['gen'] . ')';
                        }

                        $textExt = $prefix . $tr['text'] . $postfix;

                        return  $textExt;
                    },
                    $response['def'][0]['tr']
                );

                // $translations = array_column($response['def'][0]['tr'], 'text');
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
