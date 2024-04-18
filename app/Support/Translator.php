<?php

namespace App\Support;

use App\Models\DictionaryEntry;
use App\Services\TranslatorContract;

class Translator
{
    public function __construct(
        protected $sourceLang = '',
        protected $targetLang = '',
        protected $sourceText = '',
        protected $remarks = '',
        protected $importance = 100,
        protected $translations = [],
        protected $transString = '',
        protected $sentence = ''
    ) {
    }

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

    public function searchExistingEntry()
    {
        $dictionaryEntry = DictionaryEntry::where('text', $this->sourceText)
            ->where('user_id', auth()->user()->id)
            ->where('lang', $this->sourceLang)
            ->first();

        if (!is_null($dictionaryEntry)) {
            $this->sourceText = $dictionaryEntry->text;

            $this->remarks = $dictionaryEntry->remarks;

            $this->importance = $dictionaryEntry->importance;

            $translationRecord = $dictionaryEntry->translations()
                ->where('lang', $this->targetLang)
                ->first();

            if (!is_null($translationRecord)) {
                $this->transString = $translationRecord->text;
            }

            $sentenceRecord = $dictionaryEntry->sentence()
                ->first();

            if (!is_null($sentenceRecord)) {
                $this->sentence = $sentenceRecord->text;
            }
        }
    }

    public function translate()
    {
        if ($this->sourceText !== '') {
            $translationData = app(TranslatorContract::class)::translate(
                $this->sourceLang,
                $this->targetLang,
                $this->sourceText
            );

            if (isset($translationData['remarks'])) {
                $this->remarks = $translationData['remarks'];
            }

            if (isset($translationData['translations'])) {
                $this->translations = $translationData['translations'];
            }
        }
    }

    public function transToStr(array $selectedTranslations)
    {
        $this->transString = implode('; ', $selectedTranslations);
    }

    public function saveEntry()
    {
        $entry = DictionaryEntry::updateOrCreate(
            [
                'lang' => $this->sourceLang,
                'text' => $this->sourceText,
                'user_id' => auth()->user()->id,
            ],
            [
                'remarks' => $this->remarks,
                'importance' => $this->importance,
            ]
        );

        $entry->translations()->updateOrCreate(
            ['lang' => $this->targetLang],
            ['text' => $this->transString]
        );

        if ($this->sentence === '') {
            if ($entry->sentence()->exists()) {
                $entry->sentence()->delete();
            }
        } else {
            $entry->sentence()->updateOrCreate(
                [],
                ['text' => $this->sentence]
            );
        }
    }

    public function saveAttributesToSession(): void
    {
        $vars = get_object_vars($this);

        foreach ($vars as $key => $var) {
            session()->put($key, $var);
        }
    }

    public function restoreAttributesFromSession(): void
    {
        $vars = get_object_vars($this);

        foreach ($vars as $key => $value) {
            $this->$value = session()->get($key);
        }
    }

}
