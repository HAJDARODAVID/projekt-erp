<div class="list-group-item {{ $priority[$item->priority] }} py-1">
    <x-spinner />
    <div class="d-flex justify-content-between align-items-center">
        <div class="" wire:loading.remove>
            <div class="pb-1" style="font-size: 15px;">
                <b>{{ $item->task }}</b>
            </div>
            <div style="font-size: 12px;">
                @if($item->from)
                    <div class="">Od: {{ $from }}</div> 
                @endif
                @if($item->deadline)
                    <div class="">Termin: {{ $item->deadline }}</div>
                @endif
            </div>
            
        </div>
        <div class="" wire:loading.remove>
            <button class="btn btn-success btn-sm shadow" wire:click='changeItemStatus(2)'><i class="bi bi-check"></i></button>
            {{-- <button class="btn btn-primary btn-sm shadow" wire:click='editItem'><i class="bi bi-pencil"></i></button> --}}
            <button class="btn btn-danger btn-sm shadow" wire:click='changeItemStatus(-1)'><i class="bi bi-x-circle"></i></button>
        </div>
    </div>
</div>

