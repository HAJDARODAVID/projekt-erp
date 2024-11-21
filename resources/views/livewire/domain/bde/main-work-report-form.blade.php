<div>
    <x-cards.card>
        <x-slot:title>evidencija radnog dana</x-slot:title>
        <x-slot:headerBtn>
            <button>x</button>
        </x-slot:title>

        {{-- DATE --}}
        <div class="">
            <h1 class="h6 "><b>Datum</b></h1>
            <input type="date" class="form-control" wire:model.change='wdr.date'>
            <hr>
        </div>
        {{-- JOB SITE  --}}
        <div class="">
            <h1 class="h6 "><b>Gradilište</b></h1>
            <select class="form-select form-select-sm @if (!$selectedJobSite) is-invalid @endif" style="display:inline" wire:model.live="selectedJobSite">
                <option value="NULL">Odaberi gradilište</option>
                @foreach($jobSites as $jobSite)
                    <option value="{{$jobSite->id}}">{{$jobSite->name}}</option>
                @endforeach
            </select>
            <hr>
        </div>
        {{-- WORK TYPE --}}
        <div>
            <h1 class="h6"><b>Vrsta terena</b></h1>
            <div class="row" wire:loading.remove>
                <div class="col d-flex justify-content-center">Doma</div>
                <div class="col d-flex justify-content-center">Teren</div>
            </div>
            <div class="row" wire:loading.remove>
                <div class="col d-flex justify-content-center">
                    <input type="checkbox" name="vales" id="" wire:model.live = "home">
                </div>
                <div class="col d-flex justify-content-center">
                    <input type="checkbox" name="" id="" wire:model.live = "field">
                </div>
            </div>

            <div class="d-flex justify-content-center" >
                <div class="spinner-border" role="status" wire:loading>
                    <span class="sr-only"></span>
                </div>
            </div>
            <hr>
        </div>
        {{-- CAR --}}
        <div class="">
            <h1 class="h6"><b>Vozilo</b></h1>
            {{ __('Registracija vozila: ') }} 
            <select class="form-select form-select-sm" style="width: 150px;display:inline" wire:model.live="selectedCar">
                <option value="0">VŽ-XXX-00</option>
                {{-- @foreach ($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->car_plates }}</option>   
                @endforeach --}}
            </select>
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
                        <input type="number" class="form-control" wire:model.blur='mileage.start'>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" wire:model.blur='mileage.end'>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        {{-- WORKER ATTENDANCE --}}
        <div>
            <h1 class="h6"><b>Prisustvo radnika</b></h1>
            <div class="row align-items-center">
                <div class="col d-flex justify-content-center">
                    <i class="bi bi-people-fill" style="color: red;"></i>&nbsp : &nbsp
                    <b style="color: red;">0</b>
                </div>
                <div class="col d-flex justify-content-center"> <button class="btn btn-success"><i class="bi bi-person-plus"></i></button></div>
                </div>
            <hr>
        </div>
        {{-- WORKER COOPERATOR --}}
        <div>
            <h1 class="h6"><b>Prisustvo kooperanata</b></h1>
            <div class="row align-items-center">
                <div class="col d-flex justify-content-center">
                    <i class="bi bi-people-fill" style="color: red;"></i>&nbsp : &nbsp
                    <b style="color: red;">0</b>
                </div>
                <div class="col d-flex justify-content-center"> <button class="btn btn-success"><i class="bi bi-person-plus"></i></button></div>
                </div>
            <hr>
        </div>

        {{-- BTNS --}}
        <div class="col d-flex justify-content-center mb-2"> 
            <button id="workLog" class="btn btn-dark " style="width: 175px;">
                <i class="bi bi-book"></i> DNEVNIK RADOVA
            </button>
        </div>

        <div class="col d-flex justify-content-center"> 
            <button class="btn btn-danger " style="width: 175px">
                <i class="bi bi-trash"></i> OBRIŠI ZAPIS
            </button>
        </div>
        
    </x-cards.card>
</div>
