<div class="basis-auto w-[400px] space-y-4 p-5 rounded-lg border border-solid border-black bg-gray/5 text-dark">

    <div class="text-lg flex mt-[-5px] items-center">
        Delete entry {{ $id }} "<p class="text-xl font-bold">{{ $sourceText }}</p>"?
    </div>

    <div class="w-full flex justify-between space-x-4 mt-3">
        <x-button wire:click="delete" type="button" tabindex="-1" class="w-full !h-16 justify-center">
            <div wire:loading wire:target="delete"
                class="inline-block h-4 w-4 animate-spin rounded-full border-2 border-solid border-current border-e-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
                role="status">
            </div>
            Yes
        </x-button>
        <x-button x-on:click="setShowPropertyTo(false)" type="button" tabindex="-1"
            class="w-full !h-16 justify-center">
            No
        </x-button>
    </div>
</div>
