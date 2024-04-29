<div>
    @if (!empty($translations))
        <div class = "mt-5 overflow-auto max-h-[150px] lg:max-h-[100%]">
            @foreach ($translations as $translation)
                <div>
                    <x-checkbox class="checkbox ml-2" name="t-{{ $loop->index }}" type="checkbox"
                        value="{{ $translation }}" id="t-{{ $loop->index }}"></x-checkbox>
                    <label for="t-{{ $loop->index }}" class="ml-2 text-lg">
                        {{ $translation }}
                    </label>
                </div>
            @endforeach
        </div>
    @endif
</div>
