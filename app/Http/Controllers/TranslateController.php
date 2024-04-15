<?php

namespace App\Http\Controllers;

use App\Models\DictionaryEntry;
use Illuminate\Http\Request;
use App\Services\TranslatorContract;
use GuzzleHttp\Cookie\SetCookie;
use Illuminate\Support\Facades\Cookie;

class TranslateController extends Controller
{
    public function translate(Request $request)
    {
        $languages = config('voc.languages', []);

        $sourceLang = $request->source_lang ?? Cookie::get('source_lang', 'en');
        $targetLang = $request->target_lang ?? Cookie::get('target_lang', 'ru');

        Cookie::queue(Cookie::make('source_lang', $sourceLang, 60 * 24 * 7));
        Cookie::queue(Cookie::make('target_lang', $targetLang, 60 * 24 * 7));

        $sourceText = $request->text ?? '';

        $remarks = $request->remarks ?? '';

        $translations = [];

        if ($sourceText !== '') {
            $translationData = app(TranslatorContract::class)::translate($sourceLang, $targetLang, $sourceText);

            if (isset($translationData['remarks'])) {
                $remarks = $translationData['remarks'];
            }

            if (isset($translationData['translations'])) {
                $translations = $translationData['translations'];
            }
        }

        $transString =  $request->transString ?? '';

        return view('translator.translate', [
            'languages' => $languages,
            'sourceLang' => $sourceLang,
            'targetLang' => $targetLang,
            'sourceText' => $sourceText,
            'remarks' => $remarks,
            'translations' => $translations,
            'transString' => $transString,
        ]);
    }

    public function transToStr(Request $request)
    {
        $text = $request->text ?? '';

        $remarks = $request->remarks ?? '';

        $translations = array_slice($request->post(), 3);

        $transString = implode('; ', $translations);

        return redirect()->route('translate', compact('transString', 'text', 'remarks'));
    }

    public function save(Request $request)
    {
        $user = $request->user();
        $sourceLang = $request->source_lang ?? '';
        $targetLang = $request->target_lang ?? '';
        $text = $request->source_text ?? '';
        $remarks = $request->remarks ?? '';
        $translations = $request->translations ?? '';
        $sentence = $request->sentence ?? '';

        $entry = DictionaryEntry::updateOrCreate(
            ['lang' => $sourceLang, 'text' => $text, 'user_id' => $user->id],
            ['remarks' => $remarks]
        );

        $entry->translations()->updateOrCreate(
            ['lang' => $targetLang],
            ['text' => $translations]
        );

        $entry->sentence()->updateOrCreate(
            [],
            ['text' => $sentence]
        );

        return redirect()->route('translate');
    }

}
