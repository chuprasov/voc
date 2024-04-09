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
        $sourceWord = $request->sourceWord ?? '';

        return view('translator.index', compact('translations', 'transString', 'sourceWord'));
    }

    public function translateWord(Request $request)
    {
        $translations = app(TranslatorContract::class)::translate('ru', 'de', $request->word);
        $sourceWord = $request->word;

        return redirect()->route('translator.index', compact('translations', 'sourceWord'));
    }

    public function transToStr(Request $request)
    {
        $sourceWord = $request->word ?? '';

        $translations = array_slice($request->query(), 1);

        $transString = implode(', ', $translations);

        return redirect()->route('translator.index', compact('transString', 'sourceWord'));
    }

}
