<?php

namespace App\Livewire;

use Livewire\Component;
use App\Support\TranslatorWeb;
use Livewire\Attributes\On;

class DictionaryEntry extends Component
{
    public string $sourceLang;
    public string $targetLang;
    public string $sourceText;
    public string $remarks;
    public int $importance;
    public string $transString;
    public string $sentence;
    public string $message = '';

    /* public $listeners = [
        'searched' => 'refreshAll',
    ]; */

    #[On('translated'), On('searched')]
    public function refreshAll(): void
    {
        $this->reset('message');

        $this->sourceLang = session()->get('sourceLang');
        $this->targetLang = session()->get('targetLang');
        $this->sourceText = session()->get('sourceText');
        $this->remarks = session()->get('remarks');
        $this->importance = session()->get('importance');
        $this->transString = session()->get('transString');
        $this->sentence = session()->get('sentence');
    }

    #[On('to-str-converted')]
    public function refreshTransString(): void
    {
        $this->transString = session()->get('transString');
    }

    #[On('saved')]
    public function showMessage(): void
    {
        $this->message = 'Entry saved!';
    }

    public function saveEntry(): void
    {
        $translator = new TranslatorWeb(
            sourceLang: $this->sourceLang,
            targetLang: $this->targetLang,
            sourceText: $this->sourceText,
            remarks: $this->remarks,
            importance: $this->importance,
            transString: $this->transString,
            sentence: $this->sentence,
        );

        $translator->saveEntry();

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.dictionary-entry');
    }
}
