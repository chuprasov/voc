<?php

namespace App\Http\Controllers;

use App\Models\DictionaryEntry;
use App\Services\TranslatorContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class TranslateController extends Controller
{
    public function index(Request $request)
    {
        $sourceLang = Cookie::get('source_lang', 'en');
        $targetLang = Cookie::get('target_lang', 'ru');

        $sourceText = $request->sourceText;
        $remarks = $request->remarks;
        $importance = $request->importance ?? 100;
        $translations = $request->translations ?? [];
        $transString = $request->transString;
        $sentence = $request->sentence;

        return view('translator.translate', compact(
            'sourceLang',
            'targetLang',
            'sourceText',
            'remarks',
            'importance',
            'translations',
            'transString',
            'sentence'
        ));
    }

    public function translate(Request $request)
    {
        $sourceLang = $request->source_lang;
        $targetLang = $request->target_lang;

        Cookie::queue(Cookie::make('source_lang', $sourceLang, 60 * 24 * 7));
        Cookie::queue(Cookie::make('target_lang', $targetLang, 60 * 24 * 7));

        $sourceText = $request->source_text;
        $remarks = '';
        $transString = '';
        $sentence = '';

        if ($sourceText !== '') {
            $translationData = app(TranslatorContract::class)::translate($sourceLang, $targetLang, $sourceText);

            if (isset($translationData['remarks'])) {
                $remarks = $translationData['remarks'];
            }

            if (isset($translationData['translations'])) {
                $translations = $translationData['translations'];
            }
        }

        // Search for existing translations

        $dictionaryEntry = DictionaryEntry::where('text', $sourceText)
            ->where('lang', $sourceLang)
            ->first();

        if (! is_null($dictionaryEntry)) {
            $sourceText = $dictionaryEntry->text;

            $remarks = $dictionaryEntry->remarks;

            $translationRecord = $dictionaryEntry->translations()
                ->where('lang', $targetLang)
                ->first();

            if (! is_null($translationRecord)) {
                $transString = $translationRecord->text;
            }

            $sentenceRecord = $dictionaryEntry->sentence()
                ->first();

            if (! is_null($sentenceRecord)) {
                $sentence = $sentenceRecord->text;
            }
        }

        return redirect()->route('translate.index', compact(
            'sourceText',
            'remarks',
            'translations',
            'transString',
            'sentence'
        ));
    }

    public function transToStr(Request $request)
    {
        $sourceText = $request->source_text;
        $remarks = $request->remarks;

        $translations = array_slice($request->post(), 3);

        $transString = implode('; ', $translations);

        return redirect()->route('translate', compact(
            'transString',
            'sourceText',
            'remarks'
        ));
    }

    public function save(Request $request)
    {
        $user = $request->user();
        $sourceLang = Cookie::get('source_lang');
        $targetLang = Cookie::get('target_lang');
        $sourceText = $request->source_text;
        $remarks = $request->remarks;
        $importance = $request->importance ?? 100;
        $transString = $request->trans_string;
        $sentence = $request->sentence;

        $entry = DictionaryEntry::updateOrCreate(
            [
                'lang' => $sourceLang,
                'text' => $sourceText,
                'user_id' => $user->id,
            ],
            [
                'remarks' => $remarks,
                'importance' => $importance,
            ]
        );

        $entry->translations()->updateOrCreate(
            ['lang' => $targetLang],
            ['text' => $transString]
        );

        if (is_null($sentence)) {
            if ($entry->sentence()->exists()) {
                $entry->sentence()->delete();
            }
        } else {
            $entry->sentence()->updateOrCreate(
                [],
                ['text' => $sentence]
            );
        }

        return redirect()->route('translate');
    }
}
