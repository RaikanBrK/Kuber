<x-adminlte-card 
    :title="$title"
    :theme="$theme"
    :collapsible="$collapsible"
    :removable="$removable"
    :maximizable="$maximizable"
>
    {{ $slot }}
    @if($send || $back)
    <x-slot name="footerSlot">
        <div class="d-flex justify-content-{{ ($send && $back) ? 'between' : 'end' }} align-items-center">
            @if($back) 
                <a href="{{ route($back) }}" class="btn btn-sm btn-outline-info">
                    <i class="fas fa-arrow-left"></i>
                    {{ __('kuber::components/widget/card.back') }}
                </a>
            @endif
            @if($send)
                @if($send == 'save')
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i>
                        {{ __('kuber::components/widget/card.save') }}
                    </button>
                @else
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i>
                        {{ __('kuber::components/widget/card.create') }}
                    </button>
                @endif
            @endif
        </div>
    </x-slot>
    @endif
</x-adminlte-card>