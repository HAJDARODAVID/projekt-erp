<div>
    <div wire:loading.remove>
        <div class="d-flex">
            <input type="text" class="form-control form-control-sm mx-2" wire:model.blur='qtyValue' style="width:60px">
            <button class="btn btn-danger btn-sm" wire:click='deleteFromList()'>X</button>
        </div>
    </div>

    <div class="d-flex justify-content-center" >
        <div class="spinner-border" role="status" style="display:none" wire:loading>
            <span class="sr-only"></span>
        </div>
    </div>
</div>
