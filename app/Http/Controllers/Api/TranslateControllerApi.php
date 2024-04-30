<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\DictionaryEntry;
use App\Http\Controllers\Controller;
use App\Services\TranslatorContract;
use App\Support\TranslatorApi;

class TranslateControllerApi extends Controller
{
    /**
     * Translate text
     *
     * @response array{
     * service: string,
     * sourceLang: string,
     * targetLang: string,
     * sourceText: string,
     * remarks: string,
     * translations: array<string>}
     */
    public function translateText(Request $request)
    {
        $request->validate([
            'sourceLang' => 'required|max:2',
            'targetLang' => 'required|max:2',
            'text' => 'required|max:255',
        ]);

        $translator = new TranslatorApi(
            sourceLang: $request->sourceLang,
            targetLang: $request->targetLang,
            sourceText: $request->text,
        );

        return $translator->translateApi();
    }

    /**
     * Search existing dictionary entries
     *
     * @response array{text: string, results: array<string>}
     */
    public function search(Request $request)
    {
        $request->validate([
            'text' => 'string',
        ]);

        $text = $request->text ?? '';
        $searchResult = [];

        if ($text !== '') {

            $searchResult = DictionaryEntry::where('text', 'LIKE', '%' . $text . '%')
                ->get()
                ->pluck('text')
                ->toArray();
        }

        return array_merge(
            ['text' => $text],
            ['results' => $searchResult]
        );
    }
}
