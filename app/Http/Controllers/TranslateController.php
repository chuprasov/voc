<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TranslatorContract;

class TranslateController extends Controller
{
    public function index(Request $request)
    {
        $translations = $request->translations ?? [];
        $transString = $request->transString ?? '';
        $sourceText = $request->sourceText ?? '';

        return view('translator.index', compact('translations', 'transString', 'sourceText'));
    }

    public function translateText(Request $request)
    {
        $translationData = app(TranslatorContract::class)::translate('ru', 'de', $request->word);

        $sourceText = isset($translationData['text']) ? $translationData['text'] : $request->word;

        $translations = isset($translationData['translations']) ? $translationData['translations'] : [];

        return redirect()->route('translator.index', compact('translations', 'sourceText'));
    }

    public function transToStr(Request $request)
    {
        $sourceText = $request->word ?? '';

        $translations = array_slice($request->query(), 1);

        $transString = implode('; ', $translations);

        return redirect()->route('translator.index', compact('transString', 'sourceText'));
    }

}
