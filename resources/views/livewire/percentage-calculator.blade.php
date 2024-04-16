<div>
    <div class="row mb-2">
        <div class="col col-md-5">
            <div class="form-group">
                <label for="amount1">Iznos</label>
                <input type="number" class="form-control" id="amount1" wire:model.blur='amount.amount1'>
            </div>
        </div>
        <div class="col col-md-2">
            <div class="form-group">
                <label for="percentage">@if($type=='add') Uvečaj za %:@endif @if($type=='remove') Smanji za %:@endif</label>
                <input type="number" class="form-control" id="percentage" wire:model.blur='percentage'>
            </div>
        </div>
        <div class="col col-md-5">
            <div class="form-group">
                <label for="amount2">Rezultat</label>
                <input type="number" class="form-control" id="amount2" disabled wire:model.blur='amount.amount2'>
            </div>
        </div>
    </div>
</div>

