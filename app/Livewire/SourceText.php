<?php

namespace App\Livewire;

use Livewire\Component;
use App\Support\TranslatorWeb;
use Illuminate\Support\Facades\Cookie;

use function Laravel\Prompts\alert;

class SourceText extends Component
{
    public $sourceLang;
    public $targetLang;
    public $sourceText;

    protected function newTranslator(): TranslatorWeb
    {
        Cookie::queue('source_lang', $this->sourceLang, 30 * 24 * 60);
        Cookie::queue('target_lang', $this->targetLang, 30 * 24 * 60);

        return new TranslatorWeb(
            sourceLang: $this->sourceLang,
            targetLang: $this->targetLang,
            sourceText: $this->sourceText,
        );
    }

    public function search(): void
    {
        $translator = $this->newTranslator()
            ->searchExistingEntry()
            ->saveAttributesToSession();

        $this->dispatch('searched');
    }

    public function translate()
    {
        $translator = $this->newTranslator()
            ->translate()
            ->searchExistingEntry()
            ->saveAttributesToSession();

        $this->dispatch('translated');
    }

    public function render()
    {
        return view('livewire.source-text');
    }
}
