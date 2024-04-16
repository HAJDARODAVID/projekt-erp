<div>
    <div class="row mb-2">
        <div class="col col-md-@if($type=='add') 4 @else 5 @endif">
            <div class="form-group">
                <label for="amount1">Iznos</label>
                <input type="number" class="form-control" id="amount1" wire:model.blur='amount.amount1'>
            </div>
        </div>
        <div class="col col-md-2">
            <div class="form-group">
                <label for="percentage">{{ $text['text01'] }}</label>
                <input type="number" class="form-control" id="percentage" wire:model.blur='percentage'>
            </div>
        </div>
        @if ($type=='add')
        <div class="col col-md-1 pt-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" value="add" wire:model.live='percentageType'>
                <label class="form-check-label" for="exampleRadios1">
                    +
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="deduct" wire:model.live='percentageType'>
                <label class="form-check-label" for="exampleRadios2">
                -
                </label>
            </div>
        </div>
        @endif
        <div class="col col-md-@if($type=='add') 4 @else 5 @endif">
            <div class="form-group">
                <label for="amount2">Rezultat</label>
                <input type="number" class="form-control" id="amount2" disabled wire:model.blur='amount.amount2'>
            </div>
        </div>
        
    </div>
</div>

