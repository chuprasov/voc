<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TranslatorContract;

class TranslateController extends Controller
{
    public function index(Request $request)
    {
        $sourceLang = 'ru';
        $targetLang = 'de';
        $translations = $request->translations ?? [];
        $transString = $request->transString ?? '';
        $sourceText = $request->sourceText ?? '';
        $languages = config('voc.languages');

        return view('translator.index', compact(
            'sourceLang',
            'targetLang',
            'translations',
            'transString',
            'sourceText',
            'languages'
        ));
    }

    public function translateText(Request $request)
    {
        $sourceLang = $request->source_lang;
        $targetLang = $request->target_lang;

        $translationData = app(TranslatorContract::class)::translate($sourceLang, $targetLang, $request->text);

        $sourceText = isset($translationData['text']) ? $translationData['text'] : $request->text;
        $translations = isset($translationData['translations']) ? $translationData['translations'] : [];

        return redirect()->route('translator.index', compact(
            'sourceLang',
            'targetLang',
            'translations',
            'sourceText'
        ));
    }

    public function transToStr(Request $request)
    {
        $sourceText = $request->word ?? '';

        $translations = array_slice($request->query(), 1);

        $transString = implode('; ', $translations);

        return redirect()->route('translator.index', compact('transString', 'sourceText'));
    }

}
