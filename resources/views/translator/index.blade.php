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
                                    <x-input type="text" name="word" placeholder="word" value="{{ $sourceText }}"
                                        class="w-full !h-16 text-lg" required :isError="$errors->has('word')" />

                                    <div>
                                        <x-button type="submit" class="mt-4 w-full !h-16 justify-center">
                                            Translate
                                        </x-button>
                                    </div>
                                </form>
                                <form action="{{ route('tostr') }}" method="GET">
                                    @isset($translations)
                                        <input type="hidden" name="word" id="word" value="{{ $sourceText }}">
                                        <div class = "overflow-auto max-h-[150px] lg:max-h-[100%]">
                                            @foreach ($translations as $translation)
                                                <div>
                                                    <x-checkbox class="ml-2" name="t-{{ $loop->index }}" type="checkbox"
                                                        value="{{ $translation }}" id="t-{{ $loop->index }}"></x-checkbox>
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
