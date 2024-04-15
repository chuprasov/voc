<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslateController;

Route::get('/', function () {
    return redirect(route('translate'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::controller(TranslateController::class)->group(function () {
        Route::get('/translate', 'translate')->name('translate');
        Route::post('/tostr', 'transToStr')->name('tostr');
        Route::post('/save', 'save')->name('save');
    });
});
