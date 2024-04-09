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
            $response = Http::get(self::HOST.'/lookup', [
                'key' => env('YANDEX_API_KEY', ''),
                'lang' => $sourceLang . '-'. $targetLang,
                'text' => $text,
            ])->throw()->json();

            $translates = [];

            $transItems = array_column($response['def'],'tr');
            
            foreach ($transItems as $item) {
                $translates = array_merge($translates, array_column($item,'text'));
            }

            return $translates;

        } catch (Exception $e) {
            return [$e];
        }
    }
}
