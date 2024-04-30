<?php

namespace App\Http\Controllers;

use App\Support\TranslatorWeb;
use Illuminate\Support\Facades\Cookie;

class TranslateController extends Controller
{
    public function index()
    {
        $translator = new TranslatorWeb(
            sourceLang: Cookie::get('source_lang', 'en'),
            targetLang: Cookie::get('target_lang', 'ru'),
        );

        return $translator->index();
    }
}
