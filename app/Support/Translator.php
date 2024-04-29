<?php

namespace App\Support;

use App\Models\DictionaryEntry;
use App\Services\TranslatorContract;

class Translator
{
    public function __construct(
        protected $service = 'auto',
        protected $sourceLang = '',
        protected $targetLang = '',
        protected $sourceText = '',
        protected $remarks = '',
        protected $importance = 50,
        protected $translations = [],
        protected $transString = '',
        protected $sentence = ''
    ) {
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

        return $this;
    }

    public function translate()
    {
        if ($this->sourceText !== '') {
            $translationData = app(TranslatorContract::class)::translate(
                $this->sourceLang,
                $this->targetLang,
                $this->sourceText
            );

            if (isset($translationData['service'])) {
                $this->service = $translationData['service'];
            }

            if (isset($translationData['text'])) {
                $this->sourceText = $translationData['text'];
            }

            if (isset($translationData['remarks'])) {
                $this->remarks = $translationData['remarks'];
            }

            if (isset($translationData['translations'])) {
                $this->translations = $translationData['translations'];
            }
        }

        return $this;
    }

    public function transToStr(array $selectedTranslations)
    {
        $this->transString = implode('; ', $selectedTranslations);

        return $this;
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

        return $this;
    }

}
