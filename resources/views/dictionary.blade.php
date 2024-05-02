<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section>
                    <div class="flex flex-col">
                        @foreach ($translations as $index => $translation)
                        <div class="basis-auto xl:basis-3/4 w-full space-y-4 p-4 {{ $loop->index % 2 == 0 ? 'bg-gray-200' : 'bg-gray-300' }} text-dark">
                                <div class="flex items-center">
                                    <div class="flex lg:space-x-4 lg:space-y-0">
                                        <div class="flex items-center border border-black border-solid px-3 py-2 rounded-lg bg-[#e5e7eb]">
                                            <div class="flex mr-2 min-h-[25px] min-w-[35px]">
                                                <img src="{{ asset('images/' . $translation->dictionaryEntry->lang . '.png') }}"
                                                    alt="" height="15px" width="25px" >
                                            </div>

                                            <p class="text-black font-bold text-2xl">
                                                {{ $translation->dictionaryEntry->text }}
                                            </p>
                                        </div>
                                        <div class="flex items-center whitespace-nowrap">
                                            <p class="text-black font-bold text-2xl">
                                                {{ $translation->dictionaryEntry->remarks }}
                                            </p>
                                        </div>
                                        
                                    </div>
                                    <div class="flex items-center flex-shrink-1">
                                        <div class="flex flex-row space-x-3 ml-5 mr-2 mt-1 min-h-[25px] min-w-[35px]">
                                            <img src="{{ asset('images/' . $translation->lang . '.png') }}" alt=""
                                                height="15" width="25">
                                        </div>
                                        <p class="text-black text-2xl">
                                            {{ $translation->text }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <p class="text-black text-2xl">
                                        {{ $translation->dictionaryEntry->sentence->text ?? '' }}
                                    </p>
                                    <div class="flex items-center">
                                        <div class="flex">
                                            <p class="text-black text-xl">
                                               Imp. {{ $translation->dictionaryEntry->importance }}%
                                            </p>
                                        </div>
                                        <button onclick="Livewire.dispatch(
                                            'openModal',
                                            { component: 'dictionary-entry', arguments: {
                                                    sourceLang: '{{ $translation->dictionaryEntry->lang }}',
                                                    targetLang: '{{ $translation->lang }}',
                                                    sourceText: '{{ $translation->dictionaryEntry->text }}',
                                                    remarks: '{{ $translation->dictionaryEntry->remarks }}',
                                                    importance: '{{ $translation->dictionaryEntry->importance }}',
                                                    transString: '{{ $translation->text }}',
                                                    sentence: '{{ $translation->dictionaryEntry->sentence->text ?? '' }}'
                                            }})">
                                            <div class="border border-black border-solid rounded-lg py-1 ml-2 bg-[#c3c4c7]">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="45px" height="35px" viewBox="0 0 24 24" fill="none">
                                                    <path d="M11 4H7.2C6.0799 4 5.51984 4 5.09202 4.21799C4.71569 4.40974 4.40973 4.7157 4.21799 5.09202C4 5.51985 4 6.0799 4 7.2V16.8C4 17.9201 4 18.4802 4.21799 18.908C4.40973 19.2843 4.71569 19.5903 5.09202 19.782C5.51984 20 6.0799 20 7.2 20H16.8C17.9201 20 18.4802 20 18.908 19.782C19.2843 19.5903 19.5903 19.2843 19.782 18.908C20 18.4802 20 17.9201 20 16.8V12.5M15.5 5.5L18.3284 8.32843M10.7627 10.2373L17.411 3.58902C18.192 2.80797 19.4584 2.80797 20.2394 3.58902C21.0205 4.37007 21.0205 5.6364 20.2394 6.41745L13.3774 13.2794C12.6158 14.0411 12.235 14.4219 11.8012 14.7247C11.4162 14.9936 11.0009 15.2162 10.564 15.3882C10.0717 15.582 9.54378 15.6885 8.48793 15.9016L8 16L8.04745 15.6678C8.21536 14.4925 8.29932 13.9048 8.49029 13.3561C8.65975 12.8692 8.89125 12.4063 9.17906 11.9786C9.50341 11.4966 9.92319 11.0768 10.7627 10.2373Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                        </button>
                                        <button id="deleat-article" class="ml-2">
                                            <div class="border border-black border-solid rounded-lg py-1 bg-[#c3c4c7]">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="45px" height="35px" viewBox="0 0 24 24" fill="none">
                                                    <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M14 10V17M10 10V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
