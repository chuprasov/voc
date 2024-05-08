<?php

namespace App\Livewire;

use Livewire\Component;
use App\Support\TranslatorWeb;
use Illuminate\Support\Facades\Cookie;

class SourceText extends Component
{
    public $sourceLang;
    public $targetLang;
    public $sourceText;
    public $service = 'auto';

    public function setCookie(): void
    {
        Cookie::queue('source_lang', $this->sourceLang, 30 * 24 * 60);
        Cookie::queue('target_lang', $this->targetLang, 30 * 24 * 60);
    }

    protected function newTranslator(): TranslatorWeb
    {
        $this->setCookie();

        return new TranslatorWeb(
            service: $this->service,
            sourceLang: $this->sourceLang,
            targetLang: $this->targetLang,
            sourceText: $this->sourceText,
        );
    }

    public function swapLang(): void
    {
        $lang = $this->sourceLang;
        $this->sourceLang = $this->targetLang;
        $this->targetLang = $lang;

        $this->setCookie();
    }

    public function search(): void
    {
        $this->newTranslator()
            ->searchExistingEntry()
            ->saveAttributesToSession();

        $this->dispatch('searched');
    }

    public function translate()
    {
        $this->newTranslator()
            ->translate($this->service)
            ->searchExistingEntry()
            ->saveAttributesToSession();

        $this->dispatch('translated');
    }

    public function render()
    {
        return view('livewire.source-text');
    }
}
