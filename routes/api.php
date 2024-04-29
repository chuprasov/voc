<?php

use App\Http\Controllers\Api\TranslateControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/translate', [TranslateControllerApi::class, 'translateText']);

Route::get('/search', [TranslateControllerApi::class, 'search']);
