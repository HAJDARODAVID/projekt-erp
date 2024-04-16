<div>
    <div class="row mb-2">
        <div class="col col-md-5">
            <div class="form-group">
                <label for="amount1">{{ $text['text1'] }}</label>
                <input type="number" class="form-control" id="amount1" wire:model.blur='amount.amount1'>
            </div>
        </div>
        <div class="col col-md-2">
            <div class="form-group">
                <label for="amount2">PDV [%]</label>
                <input type="number" class="form-control" id="amount2" wire:model.blur='pdv'>
            </div>
        </div>
        <div class="col col-md-5">
            <div class="form-group">
                <label for="amount2">{{ $text['text2'] }}</label>
                <input type="number" class="form-control" id="amount2" disabled wire:model.blur='amount.amount2'>
            </div>
        </div>
    </div>
</div>
