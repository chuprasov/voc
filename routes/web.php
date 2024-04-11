<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslateController;

Route::get('/', function () {
    return redirect(route('translator.index'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::controller(TranslateController::class)->group(function () {
        Route::get('/index', 'index')->name('translator.index');
        Route::get('/translate', 'translateWord')->name('translate');
        Route::get('/tostr', 'transToStr')->name('tostr');
    });
});
