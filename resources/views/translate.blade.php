<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section>
                    <div class="flex flex-col lg:flex-row gap-12 lg:gap-6 2xl:gap-8">
                        <aside class="basis-2/5 xl:basis-1/4">
                            <div class="p-4 rounded-lg border border-solid border-black bg-gray/5 text-dark">
                                @livewire('source-text', compact('sourceLang', 'targetLang', 'sourceText'))

                                @livewire('translations-selector', compact('translations'))
                            </div>
                        </aside>

                        @livewire('dictionary-entry', compact('sourceLang', 'targetLang', 'sourceText', 'remarks', 'importance', 'transString', 'sentence'))
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>