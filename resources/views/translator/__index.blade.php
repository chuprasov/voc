<section class="xs:mt-2 mt-16 lg:mt-10">
    <div class="flex flex-col lg:flex-row gap-12 lg:gap-6 2xl:gap-8 mt-8">
        <aside class="basis-2/5 xl:basis-1/4">
            <div
                class="overflow-auto max-h-[320px] lg:max-h-[100%] space-y-1 p-4 rounded-lg border border-solid border-black bg-gray/5 text-dark">
                <form action="{{ route('translate') }}" method="GET">
                    @csrf
                    <x-input type="text" name="word" placeholder="word" value="{{ old('word') }}"
                        class="w-full !h-16 text-lg" required :isError="$errors->has('word')" />

                    <div>
                        <x-button type="submit" class="w-full !h-16 mt-4 justify-center">Translate</x-button>
                    </div>
                </form>
                <form action="{{ route('tostr') }}" method="GET">
                    @isset($translations)
                        @foreach ($translations as $translation)
                            <div>
                                <x-checkbox name="t-{{ $loop->index }}" type="checkbox" value="{{ $translation }}"
                                    id="t-{{ $loop->index }}"></x-checkbox>
                                <label for="t-{{ $loop->index }}" class="ml-2 text-lg">
                                    {{ $translation }}
                                </label>
                            </div>
                        @endforeach
                    @endisset

                    <div>
                        <x-button type="submit" class="w-full !h-16 mt-4 justify-center">To string</x-button>
                    </div>
                </form>

            </div>
        </aside>

        <div class="basis-auto xl:basis-3/4">
            <x-forms.text-input type="text" name="translates" placeholder="translated text"
                value="{{ $transString }}" required :isError="$errors->has('word')" />
            <textarea id="message" rows="2"
                class="mt-3 block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Example sentence"></textarea>
        </div>

    </div>
</section>
