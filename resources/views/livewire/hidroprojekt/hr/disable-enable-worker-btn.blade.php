<div>
    @if ($worker->status > 0)
        <button class="btn btn-danger d-flex align-items-center"
            id="deactivateUser"
            wire:click='deactivateUser()' 
            wire:loading.attr='disabled'
        >
            <i class="bi bi-trash"></i>
        </button>
    @endif

    @if ($worker->status < 0)
        <button class="btn btn-success d-flex align-items-center"
            id="enableUser"
            wire:click='enableUser()' 
            wire:loading.attr='disabled'
        >
            <i class="bi bi-unlock"></i>
        </button>
    @endif
    
</div>
