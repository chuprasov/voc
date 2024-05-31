<div 
    class="basis-auto xl:basis-3/4 w-full space-y-4 p-5 rounded-lg border border-solid border-black bg-gray/5 text-dark">
    <div class="flex flex-col lg:flex-row lg:space-x-4 space-y-4 lg:space-y-0">
        <div class="flex flex-col space-y-4 basis-2/5">
            <div class="flex flex-row space-x-3">
                <x-label for="source_text" class="text-lg" value="Source text ({{ strtoupper($sourceLang) }})" />
                <img src="{{ asset('images/' . $sourceLang . '.png') }}" alt="" height="10" width="20">
            </div>

            <x-input wire:model="sourceText" type="text" name="sourceText" tabindex="-1"
                class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Source text..." value="{{ $sourceText }}" required :isError="$errors->has('sourceText')" />
        </div>
        <div class="flex flex-col space-y-4 basis-2/5">
            <x-label for="remarks" class="text-lg" value="Remarks" />
            <x-input wire:model="remarks" type="text" name="remarks" tabindex="-1"
                class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Remarks..." value="{{ $remarks ?? '' }}" required :isError="$errors->has('remarks')" />
        </div>
        <div class="flex flex-col space-y-4 basis-1/5">
            <x-label for="importance" class="text-lg" value="Imp., %" />
            <x-input wire:model="importance" type="text" name="importance" tabindex="-1"
                class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="100" value="{{ $importance ?? 100 }}" required :isError="$errors->has('importance')" />

        </div>
    </div>

    <div class="flex flex-row space-x-3">
        <x-label for="transString" class="text-lg" value="Translation ({{ strtoupper($targetLang) }})" />
        <img src="{{ asset('images/' . $targetLang . '.png') }}" alt="" height="10" width="20">
    </div>

    <x-input wire:model="transString" type="text" name="transString" id="trans-string" tabindex="-1"
        class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Translated text..." value="{{ $transString ?? '' }}" required :isError="$errors->has('transString')" />

    <x-label for="sentence" class="text-lg" value="Example sentence" />
    <textarea wire:model="sentence" type="text" name="sentence" rows="2" tabindex="-1"
        class="block p-2.5 w-full text-lg text-black bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Example sentence...">{{ $sentence ?? '' }}</textarea>

    <div class="{{ $message == '' ? 'hidden' : '' }} p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
        role="alert">
        {{ $message }}
    </div>

    <x-button wire:click="saveEntry" type="button" tabindex="-1" class="mt-4 w-full md:w-1/3 !h-16 justify-center">
        <div wire:loading wire:target="saveEntry"
            class="mr-5 inline-block h-4 w-4 animate-spin rounded-full border-2 border-solid border-current border-e-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
            role="status">
        </div>
        Save
    </x-button>
    
    

</div>

