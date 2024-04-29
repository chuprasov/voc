<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\DictionaryEntry;
use App\Http\Controllers\Controller;
use App\Services\TranslatorContract;
use Illuminate\Database\Eloquent\Collection;

class TranslateControllerApi extends Controller
{
    /**
     * Translate text
     *
     * @response array{text: string, pos: string, remarks: string, translations: array<string>}
     */
    public function translateText(Request $request)
    {
        $request->validate([
            'text' => 'string',
        ]);
        
        return app(TranslatorContract::class)::translate('en', 'ru', $request->text);
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
