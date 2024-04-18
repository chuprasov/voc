<?php

namespace App\Http\Controllers;

use App\Support\Translator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class TranslateController extends Controller
{
    public function index(Request $request)
    {
        $translator = new Translator(
            sourceLang: Cookie::get('source_lang', 'en'),
            targetLang: Cookie::get('target_lang', 'ru'),
        );

        return $translator->index();
    }
}
