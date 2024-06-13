<?php

namespace App\Support;

use App\Models\DictionaryEntry;
use App\Models\Translation;
use App\Services\DeepLTranslator;
use App\Services\TranslatorContract;
use App\Services\YandexTranslator;

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
        $this->sourceText = strtolower(trim($sourceText));
    }

    public function searchExistingEntry()
    {
        $dictionaryEntry = DictionaryEntry::search($this->sourceText)
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

    public function translate(string $service)
    {
        switch ($service) {
            case 'auto':
                if (strpos($this->sourceText, ' ') > 0) {
                    $serviceClass = DeepLTranslator::class;
                } else {
                    $serviceClass = YandexTranslator::class;
                }
                break;

            case 'yandex':
                $serviceClass = YandexTranslator::class;
                break;

            case 'deepl':
                $serviceClass = DeepLTranslator::class;
                break;

            default:
                $serviceClass = YandexTranslator::class;
                break;
        }

        app()->bind(TranslatorContract::class, $serviceClass);

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
                'text' => strtolower($this->sourceText),
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

    public function deleteEntry(int $translationId)
    {
        $translation = Translation::find($translationId);

        $dictionaryEntry = $translation->dictionaryEntry;

        $entryTransaltions = $dictionaryEntry->translations;

        // dd($entryTransaltions);
    }

}
