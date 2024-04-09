<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslateController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/index', [TranslateController::class, 'index'])->name('translator.index');
    Route::get('/translate', [TranslateController::class, 'translateWord'])->name('translate');
    Route::get('/tostr', [TranslateController::class, 'transToStr'])->name('tostr');
});
