<?php

namespace App\Livewire;

use Livewire\Component;
use App\Support\TranslatorWeb;
use Livewire\Attributes\On;

class TranslationsSelector extends Component
{
    public array $translations = [];
    public array $translationsSelected = [];

    #[On('translated')]
    public function refreshTranslations(): void
    {
        $this->reset();
        $this->translations = session()->get('translations');
    }

    public function toStr(): void
    {
        $translator = new TranslatorWeb(
            sourceLang: session()->get('sourceLang'),
            targetLang: session()->get('targetLang'),
            sourceText: session()->get('sourceText'),
        );

        $translator->transToStr($this->translations)
            ->saveAttributesToSession();

        $this->dispatch('to-str-converted');
    }

    public function render()
    {
        return view('livewire.translations-selector');
    }

    public function rendered($view, $html)
    {
        $this->dispatch('translations-rendered');
    }

}
