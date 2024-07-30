<div>
    @if (!$newStyle)
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
    @endif

    @if ($newStyle)
        <div class="mb-2">
            <b>Koliko je</b> 
            <input type="number" class="form-control" style="width: 80px;display: inline" wire:model.blur='data.percentageOfAmount.percentage'><b>%</b>
            <b>od</b>
            <input type="number" class="form-control" style="width: 150px;display: inline" wire:model.blur='data.percentageOfAmount.amount'>
            <b>=</b>
            <input type="number" class="form-control" style="width: 150px;display: inline" disabled wire:model.live='data.percentageOfAmount.result'>
            <i>Primjer: Koliko je <b>35</b>% od <b>365,38</b> = <b>127,88</b></i>
        </div>

        <div class="mb-2"> 
            <input type="number" class="form-control" style="width: 150px;display: inline" wire:model.blur='data.percentageFromAmount.amountI'>
            <b>je koji postotak od</b>
            <input type="number" class="form-control" style="width: 150px;display: inline" wire:model.blur='data.percentageFromAmount.amountII'>
            <b>=</b>
            <input type="number" class="form-control" style="width: 80px;display: inline" disabled wire:model.live='data.percentageFromAmount.result'> <b>%</b>
            <i>Primjer: <b>75</b> je koji postotak od <b>100</b> = <b>75%</b></i>
        </div>

        <div class="mb-4">
            <input type="number" class="form-control" style="width: 150px;display: inline" wire:model.blur='data.amountFromPercentage.amount'>
            <b> je </b>
            <input type="number" class="form-control" style="width: 80px;display: inline" wire:model.blur='data.amountFromPercentage.percentage'>
            <b>% od </b>
            <input type="number" class="form-control" style="width: 150px;display: inline" disabled wire:model.live='data.amountFromPercentage.result'>
            <i>Primjer: <b>100</b> je <b>10</b>% od <b>1000</b></i>
        </div>

        <div class="mb-2">
            <b>Uvećaj</b>
            <input type="number" class="form-control" style="width: 150px;display: inline" wire:model.blur='data.enlargeAmountForPercentage.amount'>
            <b> za </b>
            <input type="number" class="form-control" style="width: 80px;display: inline" wire:model.blur='data.enlargeAmountForPercentage.percentage'>
            <b>% = </b>
            <input type="number" class="form-control" style="width: 150px;display: inline" disabled wire:model.live='data.enlargeAmountForPercentage.result'>
            <i>Primjer: Uvećaj <b>100</b> za <b>5</b>% = <b>105</b></i>
        </div>
        <div class="mb-2">
            <b>Smanji</b>
            <input type="number" class="form-control" style="width: 150px;display: inline" wire:model.blur='data.decreaseAmountForPercentage.amount'>
            <b> za </b>
            <input type="number" class="form-control" style="width: 80px;display: inline" wire:model.blur='data.decreaseAmountForPercentage.percentage'>
            <b>% = </b>
            <input type="number" class="form-control" style="width: 150px;display: inline" disabled wire:model.live='data.decreaseAmountForPercentage.result'>
            <i>Primjer: Smanji <b>100</b> za <b>5</b>% = <b>95</b></i>
        </div>
    @endif
</div>

