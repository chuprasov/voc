<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section>
                    <div class="flex flex-col lg:flex-row gap-12 lg:gap-6 2xl:gap-8">
                        <aside class="basis-2/5 xl:basis-1/4">
                            <div class="space-y-1 p-4 rounded-lg border border-solid border-black bg-gray/5 text-dark">
                                <form action="{{ route('translate') }}" method="POST">
                                    @csrf
                                    <div class="space-y-4">
                                        <div class="flex flex-row space-x-4">
                                            <select name="source_lang" id="source-lang" class="block rounded-lg"
                                                wire:model="lang">
                                                @foreach (config('voc.languages', []) as $lang)
                                                    <option value="{{ $lang }}"
                                                        {{ $lang === $sourceLang ? 'selected' : '' }}>
                                                        {{ $lang }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-10">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                            </svg>

                                            <select name="target_lang" id="target-lang" class="block rounded-lg"
                                                wire:model="lang">
                                                @foreach (config('voc.languages', []) as $lang)
                                                    <option value="{{ $lang }}"
                                                        {{ $lang === $targetLang ? 'selected' : '' }}>
                                                        {{ $lang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="flex flex-row">
                                            <x-input class="basis-4/5" name="source_text" placeholder="Text..."
                                                value="{{ $sourceText }}" class="w-full !h-16 text-lg" required
                                                :isError="$errors->has('source_text')" maxlength="30" />
                                            <x-button id="search" type="button" name="search" class="basis-1/5 !h-16 ">
                                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                            </x-button>
                                        </div>

                                        <div>
                                            <x-button type="submit" class="w-full !h-16 justify-center">
                                                Translate
                                            </x-button>
                                        </div>
                                    </div>
                                </form>
                                <form action="{{ route('tostr') }}" method="POST">
                                    @csrf
                                    @isset($translations)
                                        <input type="hidden" name="source_text" value="{{ $sourceText }}">
                                        <input type="hidden" name="remarks" value="{{ $remarks ?? '' }}">
                                        <div class = "overflow-auto max-h-[150px] lg:max-h-[100%]">
                                            @foreach ($translations as $translation)
                                                <div>
                                                    <x-checkbox class="ml-2" name="t-{{ $loop->index }}" type="checkbox"
                                                        value="{{ $translation }}"
                                                        id="t-{{ $loop->index }}"></x-checkbox>
                                                    <label for="t-{{ $loop->index }}" class="ml-2 text-lg">
                                                        {{ $translation }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endisset

                                    <div>
                                        <x-button type="submit" class="mt-4 w-full !h-16 justify-center">
                                            Get selected
                                        </x-button>
                                    </div>
                                </form>

                                <x-button type="button" name="get-sel" id="get-sel" class="mt-4 w-full !h-16 justify-center">
                                    Get selected JS
                                </x-button>
                            </div>
                        </aside>

                        <form action="{{ route('save') }}" method="POST"
                            class="basis-auto xl:basis-3/4 w-full space-y-4 p-4 rounded-lg border border-solid border-black bg-gray/5 text-dark">
                            @csrf
                            <div class="flex flex-col lg:flex-row lg:space-x-4 space-y-4 lg:space-y-0">
                                <div class="flex flex-col space-y-4 basis-2/5">
                                    <div class="flex flex-row space-x-3">
                                        <x-label for="source_text" class="text-lg"
                                            value="Source text ({{ strtoupper($sourceLang) }})" />

                                        <img src="{{ asset('images/' . $sourceLang . '.png') }}" alt=""
                                            height="10" width="20">

                                    </div>

                                    <x-input type="text" name="source_text"
                                        class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Source text..." value="{{ $sourceText }}" required
                                        :isError="$errors->has('source_text')" />
                                </div>
                                <div class="flex flex-col space-y-4 basis-2/5">
                                    <x-label for="remarks" class="text-lg" value="Remarks" />
                                    <x-input type="text" name="remarks"
                                        class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Remarks..." value="{{ $remarks ?? '' }}" required
                                        :isError="$errors->has('remarks')" />
                                </div>
                                <div class="flex flex-col space-y-4 basis-1/5">
                                    <x-label for="importance" class="text-lg" value="Importance, %" />
                                    <x-input type="text" name="importance"
                                        class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="100" value="{{ $importance ?? 100 }}" required
                                        :isError="$errors->has('importance')" />

                                </div>
                            </div>

                            <div class="flex flex-row space-x-3">
                                <x-label for="trans_string" class="text-lg"
                                    value="Translation ({{ strtoupper($targetLang) }})" />
                                <img src="{{ asset('images/' . $targetLang . '.png') }}" alt=""
                                    height="10" width="20">
                            </div>

                            <x-input type="text" name="trans_string"
                                class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Translated text..." value="{{ $transString ?? '' }}" required
                                :isError="$errors->has('trans_string')" />

                            <x-label for="sentence" class="text-lg" value="Example sentence" />
                            <textarea id="sentence" name="sentence" rows="2"
                                class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Example sentence...">{{ $sentence ?? '' }}</textarea>
                            <x-button type="submit" class="mt-4 w-full md:w-1/3 !h-16 justify-center">
                                Save
                            </x-button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
