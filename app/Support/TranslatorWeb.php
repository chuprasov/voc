<?php

namespace App\Support;

class TranslatorWeb extends Translator
{
    public function index()
    {
        return view('translate', [
            'sourceLang' => $this->sourceLang,
            'targetLang' => $this->targetLang,
            'sourceText' => $this->sourceText,
            'remarks' => $this->remarks,
            'importance' => $this->importance,
            'translations' => $this->translations,
            'transString' => $this->transString,
            'sentence' => $this->sentence
        ]);
    }

    public function saveAttributesToSession()
    {
        $vars = get_object_vars($this);

        foreach ($vars as $key => $var) {
            session()->put($key, $var);
        }

        return $this;
    }

    public function restoreAttributesFromSession()
    {
        $vars = get_object_vars($this);

        foreach ($vars as $key => $value) {
            $this->$value = session()->get($key);
        }

        return $this;
    }
}
