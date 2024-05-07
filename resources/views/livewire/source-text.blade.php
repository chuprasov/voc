<div>
    <div class="space-y-4">
        <div class="flex flex-row space-x-4">
            <select name="sourceLang" id="sourceLang" class="block rounded-lg" wire:model="sourceLang">
                @foreach (config('voc.languages', []) as $lang)
                    <option value="{{ $lang }}" {{ $lang === $sourceLang ? 'selected' : '' }}>
                        {{ $lang }}
                    </option>
                @endforeach
            </select>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
            </svg>

            <select name="targetLang" id="targetLang" class="block rounded-lg" wire:model="targetLang">
                @foreach (config('voc.languages', []) as $lang)
                    <option value="{{ $lang }}" {{ $lang === $targetLang ? 'selected' : '' }}>
                        {{ $lang }}
                    </option>
                @endforeach
            </select>

            <x-button wire:click="swapLang" type="button" name="swap-lang" class="block rounded-lg">
                <svg fill="#FFFFFF" height="20px" width="16px" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 477.426 477.426">
                    <polygon
                        points="101.82,187.52 57.673,143.372 476.213,143.372 476.213,113.372 57.181,113.372 101.82,68.733 80.607,47.519
                                0,128.126 80.607,208.733 	" />
                    <polygon
                        points="396.82,268.694 375.607,289.907 420,334.301 1.213,334.301 1.213,364.301 420,364.301 375.607,408.694
                                396.82,429.907 477.427,349.301 	" />
                </svg>
            </x-button>

        </div>

        <div class="flex flex-row relative">
            <x-input wire:model="sourceText" list="searchResults" class="basis-4/5" name="sourceText"
                placeholder="Text..." id="sourceText" value="{{ $sourceText }}" class="w-full !h-16 text-lg pr-6" required
                :isError="$errors->has('sourceText')" maxlength="30" />
                <button id="clearBtn" class="absolute right-14 top-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>

            <x-button wire:click="search" id="searchBtn" type="button" name="search" class="basis-1/5 !h-16">
                <div wire:loading wire:target="search"
                    class="inline-block h-4 w-4 animate-spin rounded-full border-2 border-solid border-current border-e-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
                    role="status">
                </div>
                <div wire:loading.class="hidden" wire:target="search">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
            </x-button>
            <datalist id="searchResults"
                class="w-full !h-10 text-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></datalist>
        </div>

        <div>
            <x-button wire:click="translate" id="translate-button" type="button" class="w-full !h-16 justify-center">
                <div wire:loading wire:target="translate"
                    class="mr-5 inline-block h-4 w-4 animate-spin rounded-full border-2 border-solid border-current border-e-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
                    role="status">
                </div>
                <div>
                    Translate
                </div>
            </x-button>
        </div>
    </div>
</div>
