<div>
    <input class="form-control form-control-sm" style="width:50px" type="text" wire:model.blur='workType' wire:loading.remove @if (!is_null($row->absence_reason)) disabled @endif>

    <div class="d-flex justify-content-center" >
        <div class="spinner-border" role="status" style="display:none" wire:loading>
            <span class="sr-only"></span>
        </div>
    </div> 
</div>
