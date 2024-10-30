<div class="alert alert-{{ $aType }} shadow pb-2" role="alert">
    <div class="alert-heading">
        <div class="d-flex justify-content-between">
            <div class="">
                <h6 class="m-0">{{ strtoupper($title) }}</h6>
                <div style="font-size: 11px;">{{ $this->item->created_at }}</div>  
            </div>
            <div class="px-2 rounded" style="cursor: pointer" wire:click='markAsSeenBtn()'>
                <b >x</b>
            </div>
        </div>
    <hr class="p-0 m-1 mb-2">
    </div>
    <p class="text-break" wire:loading.remove>{{ $message }}</p>
    <div class="d-flex justify-content-center" >
        <div class="spinner-border" role="status" style="display:none" wire:loading wire:target="markAsSeenBtn">
            <span class="sr-only"></span>
        </div>
    </div> 
    @if($moreOption)
        <hr class="p-0 m-1 mb-2">
        <div class="d-flex justify-content-end">
            <button class="btn btn-sm" wire:loading.remove wire:click='openMore()'>
                <div class="alert alert-{{ $aType }} shadow p-0 m-0 px-3 py-0">Više...</div>
            </button>
        </div>
    @endif
</div>