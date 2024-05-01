<?php

namespace App\Http\Controllers;

use App\Models\Translation;

class DictionaryController extends Controller
{
    public function index()
    {
        $translations = Translation::query()
            ->with(['dictionaryEntry', 'dictionaryEntry.sentence'])
            ->get()
            ->sortBy('lang')
            ->sortBy('dictionaryEntry.text')
            ->sortBy('dictionaryEntry.lang');

        return view('dictionary', compact('translations'));
    }
}
