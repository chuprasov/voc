<?php

namespace App\Providers;

use App\Services\DeepLTranslator;
use App\Services\TranslatorContract;
use App\Services\YandexTranslator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        TranslatorContract::class => YandexTranslator::class,
        // TranslatorContract::class  => DeepLTranslator::class,
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
