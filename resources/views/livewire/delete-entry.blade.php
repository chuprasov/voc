<div
    class="basis-auto xl:basis-3/4 w-full space-y-4 p-5 rounded-lg border border-solid border-black bg-gray/5 text-dark">

    <div>
        Delete entry {{ $id }} "{{ $sourceText }}"?
    </div>

    <x-button wire:click="delete" type="button" tabindex="-1" class="mt-4 w-full md:w-1/3 !h-16 justify-center">
        <div wire:loading wire:target="delete"
            class="mr-5 inline-block h-4 w-4 animate-spin rounded-full border-2 border-solid border-current border-e-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
            role="status">
        </div>
        Yes
    </x-button>
    <x-button x-on:click="setShowPropertyTo(false)" type="button" tabindex="-1"
        class="mt-4 w-full md:w-1/3 !h-16 justify-center">
        No
    </x-button>
</div>
