<div>
    <h1 class="h6"><b>Vozilo</b></h1>
    {{ __('Registracija vozila: ') }} 
    <select class="form-select form-select-sm" style="width: 150px;display:inline" wire:model.live="selectedCar">
        <option value="0" selected>Odaberi vozilo</option>
        @foreach ($cars as $car)
            <option value="{{ $car->id }}">{{ $car->car_plates }}</option>   
        @endforeach
    </select>
    <hr>
    
</div>
