<div>
    <button class="btn btn-danger btn-sm" wire:click='deleteEntry' wire:loading.remove><i class="bi bi-trash"></i></button>

    <div class="d-flex justify-content-center" >
        <div class="spinner-border" role="status" style="display:none" wire:loading>
            <span class="sr-only"></span>
        </div>
    </div>
</div>
