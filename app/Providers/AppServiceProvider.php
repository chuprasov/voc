<?php

namespace App\Providers;

use App\Services\YandexTranslator;
use App\Services\TranslatorContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        TranslatorContract::class  => YandexTranslator::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
