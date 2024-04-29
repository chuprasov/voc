<?php

namespace App\Support;

class TranslatorApi extends Translator
{
    public function translateApi()
    {
        $this->translate();

        return array_merge(
            [
                'service' => $this->service,
                'sourceLang' => $this->sourceLang,
                'targetLang' => $this->targetLang,
                'sourceText' => $this->sourceText,
                'remarks' => $this->remarks,
            ],
            ['translations' => $this->translations]
        );
    }
}
