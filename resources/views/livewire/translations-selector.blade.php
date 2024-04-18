<div>
    @isset($translations)
        <div class = "overflow-auto max-h-[150px] lg:max-h-[100%]">
            @foreach ($translations as $translation)
                <div>
                    <x-checkbox class="ml-2" name="t-{{ $loop->index }}" type="checkbox" value="{{ $translation }}"
                        id="t-{{ $loop->index }}"></x-checkbox>
                    <label for="t-{{ $loop->index }}" class="ml-2 text-lg">
                        {{ $translation }}
                    </label>
                </div>
            @endforeach
        </div>
    @endisset

    <div>
        <x-button wire:click="toStr" type="button" class="mt-4 w-full !h-16 justify-center">
            Get selected
        </x-button>
    </div>
</div>

@script
    <script>
        /* $wire.on('to-str-converted', (event) => {
            alert('to-str-converted');
        }) */
    </script>
@endscript