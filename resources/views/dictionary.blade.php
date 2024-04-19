<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section>
                    <div class="flex flex-col gap-12 lg:gap-6 2xl:gap-8">
                        @foreach ($translations as $translation)
                            <div
                                class="basis-auto xl:basis-3/4 w-full space-y-4 p-4 rounded-lg border border-solid border-black bg-gray/5 text-dark">
                                <div class="flex flex-col lg:flex-row lg:space-x-4 space-y-4 lg:space-y-0">
                                    <div class="flex flex-col space-y-4 basis-2/5">
                                        <div class="flex flex-row space-x-3">
                                            <x-label for="source_text" class="text-lg"
                                                value="Source text ({{ strtoupper($translation->dictionaryEntry->lang) }})" />

                                            <img src="{{ asset('images/' . $translation->dictionaryEntry->lang . '.png') }}" alt=""
                                                height="10" width="20">

                                        </div>

                                        <x-input type="text" name="sourceText"
                                            class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Source text..." value="{{ $translation->dictionaryEntry->text }}" required
                                            :isError="$errors->has('sourceText')" />
                                    </div>
                                    <div class="flex flex-col space-y-4 basis-2/5">
                                        <x-label for="remarks" class="text-lg" value="Remarks" />
                                        <x-input type="text" name="remarks"
                                            class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Remarks..." value="{{ $translation->dictionaryEntry->remarks}}" required
                                            :isError="$errors->has('remarks')" />
                                    </div>
                                    <div class="flex flex-col space-y-4 basis-1/5">
                                        <x-label for="importance" class="text-lg" value="Importance, %" />
                                        <x-input type="text" name="importance"
                                            class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="100" value="{{ $translation->dictionaryEntry->importance}}" required
                                            :isError="$errors->has('importance')" />

                                    </div>
                                </div>

                                <div class="flex flex-row space-x-3">
                                    <x-label for="transString" class="text-lg"
                                        value="Translation ({{ strtoupper($translation->lang) }})" />
                                    <img src="{{ asset('images/' . $translation->lang . '.png') }}" alt=""
                                        height="10" width="20">
                                </div>

                                <x-input type="text" name="transString"
                                    class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Translated text..." value="{{ $translation->text}}" required
                                    :isError="$errors->has('transString')" />

                                <x-label for="sentence" class="text-lg" value="Example sentence" />
                                <textarea type="text" name="sentence" rows="2"
                                    class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Example sentence...">{{ $translation->dictionaryEntry->sentence()->first()->text ?? '' }}</textarea>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
