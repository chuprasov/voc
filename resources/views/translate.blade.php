<x-app-layout>
    <div class="py-12 px-2 lg:px-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#e5e7eb] lg:bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section>
                    <div class="flex flex-col lg:flex-row gap-12 lg:gap-6 2xl:gap-8">
                        <aside class="basis-2/5 xl:basis-1/4 bg-white">
                            <div class="p-4 rounded-lg border border-solid border-black bg-gray/5 text-dark">
                                @livewire('source-text', compact('sourceLang', 'targetLang', 'sourceText'))

                                @livewire('translations-selector', compact('translations'))
                            </div>
                        </aside>
                        <div class="bg-white w-full">
                            @livewire('dictionary-entry', compact('sourceLang', 'targetLang', 'sourceText', 'remarks', 'importance', 'transString', 'sentence'))
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
