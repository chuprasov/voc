<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslateController;
use App\Http\Controllers\DictionaryController;

Route::get('/', function () {
    return redirect(route('translate.index'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::controller(TranslateController::class)->group(function () {
        Route::get('/translate', 'index')->name('translate.index');
    });
    Route::controller(DictionaryController::class)->group(function () {
        Route::get('/dictionary', 'index')->name('dictionary.index');
    });
});
