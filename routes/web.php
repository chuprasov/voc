<?php

use App\Http\Controllers\TranslateController;
use Illuminate\Support\Facades\Route;

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
        Route::post('/translate', 'translate')->name('translate');
        Route::post('/tostr', 'transToStr')->name('tostr');
        Route::post('/save', 'save')->name('save');
    });
});
