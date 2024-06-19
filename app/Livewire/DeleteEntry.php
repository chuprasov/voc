<?php

namespace App\Livewire;

use App\Support\TranslatorWeb;
use LivewireUI\Modal\ModalComponent;

class DeleteEntry extends ModalComponent
{
    public string $translationId;
    public string $translationText;

    public function delete()
    {
        $translator = new TranslatorWeb();

        $translator->deleteEntry($this->translationId);

        $this->dispatch('close-modal');

        return redirect()->route('dictionary.index');
    }

    public function render()
    {
        return view('livewire.delete-entry');
    }
}
