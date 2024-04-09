<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TranslatorContract;

class TranslateControllerApi extends Controller
{
    public function translateWord(Request $request)
    {
        return app(TranslatorContract::class)::translate('en','ru',$request->word);
    }
}
