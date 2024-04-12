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
                                <form action="{{ route('translate') }}" method="GET">
                                    @csrf
                                    <div class="space-y-4">
                                        <div class="flex flex-row space-x-4">
                                            <select name="source_lang" id="source-lang" class="block rounded-lg" wire:model="gender">
                                                @foreach ($languages as $lang)
                                                    <option value="{{ $lang }}" {{ $lang === $sourceLang ? "selected" : "" }}>{{ $lang }}</option>
                                                @endforeach
                                            </select>

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-10">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                            </svg>


                                            <select name="target_lang" id="target-lang"  class="block rounded-lg" wire:model="gender">
                                                @foreach ($languages as $lang)
                                                    <option value="{{ $lang }}" {{ $lang === $targetLang ? "selected" : "" }} >
                                                        {{ $lang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <x-input type="text" name="text" placeholder="Text..."
                                            value="{{ $sourceText }}" class="w-full !h-16 text-lg" required
                                            :isError="$errors->has('word')" maxlength="30" />

                                        <div>
                                            <x-button type="submit" class="w-full !h-16 justify-center">
                                                Translate
                                            </x-button>
                                        </div>
                                    </div>
                                </form>
                                <form action="{{ route('tostr') }}" method="GET">
                                    @isset($translations)
                                        <input type="hidden" name="word" id="word" value="{{ $sourceText }}">
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

                                <x-button name="get-sel" id="get-sel" class="mt-4 w-full !h-16 justify-center">
                                    Get selected JS
                                </x-button>
                            </div>
                        </aside>

                        <div
                            class="basis-auto xl:basis-3/4 w-full space-y-4 p-4 rounded-lg border border-solid border-black bg-gray/5 text-dark">

                            <label for="translations" class="text-lg">
                                {{ $sourceText }}
                            </label>

                            <x-input type="text" name="translations"
                                class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Translated text" value="{{ $transString }}" required :isError="$errors->has('word')" />

                            <textarea id="sentence" name="sentence" rows="2"
                                class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Example sentence"></textarea>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
