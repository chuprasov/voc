<?php

namespace App\Http\Controllers;

use App\Models\Translation;

class DictionaryController extends Controller
{
    public function index()
    {
        $translations = Translation::query()->get();

        return view('dictionary', compact('translations'));
    }
}
