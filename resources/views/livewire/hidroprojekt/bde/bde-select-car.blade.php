<div>
    <h1 class="h6"><b>Vozilo</b></h1>
    {{ __('Registracija vozila: ') }} 
    <select class="form-select form-select-sm" style="width: 150px;display:inline" wire:model.live="selectedCar">
        <option value="0" selected>Odaberi vozilo</option>
        @foreach ($cars as $car)
            <option value="{{ $car->id }}">{{ $car->car_plates }}</option>   
        @endforeach
    </select>
    <div class="carMileage" style="display: @if ($showMileage) block @else none @endif">
        <div class="row mt-2">
            <div class="col">
                Početno stanje:
            </div>
            <div class="col">
                Završno stanje:
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="number" class="form-control" wire:model.blur='mileage.start'>
            </div>
            <div class="col">
                <input type="number" class="form-control" wire:model.blur='mileage.end'>
            </div>
        </div>
    </div>
    
    <hr>
    
</div>
