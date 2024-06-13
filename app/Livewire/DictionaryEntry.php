<?php

namespace App\Livewire;

use Laravel\Jetstream\InteractsWithBanner;
use App\Support\TranslatorWeb;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class DictionaryEntry extends ModalComponent
{
    use InteractsWithBanner;
    public string $sourceLang;
    public string $targetLang;
    public string $sourceText;
    public string $remarks;
    public int $importance;
    public string $transString;
    public string $sentence;
    public string $message = '';

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

        // $this->banner('Entry saved!');

        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.dictionary-entry');
    }
}
