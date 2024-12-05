<div class="">
    <h1 class="h6"><b>Vozilo</b></h1>
    {{ __('Registracija vozila: ') }} 
    <select class="form-select form-select-sm @isset ($saveStatus['car_id']) is-valid @endisset" style="width: 150px;display:inline" wire:model.live="wdr.car_id">
        <option value="NULL">VŽ-XXX-00</option>
        @foreach ($cars as $car)
            <option value="{{ $car->id }}">{{ $car->id }} - {{ $car->car_plates }}</option>   
        @endforeach
    </select>
    @if($wdr['car_id'])
        <div class="carMileage" style="display: @if (TRUE) block @else none @endif">
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
                    <input type="number" class="form-control form-control-sm @isset ($saveStatus['start_mileage']) is-valid @endisset" wire:model.blur='mileages.start_mileage'>
                </div>
                <div class="col">
                    <input type="number" class="form-control form-control-sm @isset ($saveStatus['end_mileage']) is-valid @endisset" wire:model.blur='mileages.end_mileage'>
                </div>
            </div>
        </div>
    @endif
    <hr>
</div>