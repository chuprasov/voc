<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TranslatorContract;
use Illuminate\Http\Request;

class TranslateControllerApi extends Controller
{
    public function translateText(Request $request)
    {
        return app(TranslatorContract::class)::translate('en', 'ru', $request->text);
    }
}
