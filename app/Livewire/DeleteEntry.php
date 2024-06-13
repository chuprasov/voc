<?php

namespace App\Livewire;

use App\Support\TranslatorWeb;
use LivewireUI\Modal\ModalComponent;

class DeleteEntry extends ModalComponent
{
    public string $id;
    public string $sourceText;

    public function delete(): void
    {
        $translator = new TranslatorWeb();

        $translator->deleteEntry($this->id);

        // $this->dispatch('entry-deleted');
    }

    public function render()
    {
        return view('livewire.delete-entry');
    }
}
