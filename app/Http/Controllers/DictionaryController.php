<?php

namespace App\Http\Controllers;

use App\Models\Translation;

class DictionaryController extends Controller
{
    public function index()
    {
        $translations = Translation::query()
            ->whereRelation('dictionaryEntry', 'user_id', auth()->user()->id)
            ->with(['dictionaryEntry', 'dictionaryEntry.sentence'])
            ->get()
            ->sortBy('lang')
            ->sortBy('dictionaryEntry.text')
            ->sortBy('dictionaryEntry.lang')
            ->sortBy('dictionaryEntry.importance', descending: true);

        return view('dictionary', compact('translations'));
    }
}
