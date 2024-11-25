<div>
    <x-cards.card>
        <x-slot:title>evidencija radnog dana</x-slot:title>
        <x-slot:headerBtn>
            <button class="btn btn-dark btn-sm" wire:click='returnBtn()'><i class="bi bi-arrow-return-left"></i></button> 
        </x-slot:title>

        @if ($module == 'main')
            {{-- DATE --}}
            <div class="">
                <h1 class="h6 "><b>Datum</b></h1>
                <input type="date" class="form-control @isset ($saveStatus['date']) is-valid @endisset" wire:model.change='wdr.date'>
                <hr>
            </div>
            {{-- JOB SITE  --}}
            <div class="">
                <h1 class="h6 "><b>Gradilište</b></h1>
                <select class="form-select form-select-sm @if (!$wdr['construction_site_id']) is-invalid @endif @isset ($saveStatus['construction_site_id']) is-valid @endisset" style="display:inline" wire:model.live="wdr.construction_site_id">
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
                <div class="" wire:loading.remove wire:target='wdr.work_type'>
                    <div class="row">
                        @foreach ($bdeWorkTypes as $type)
                            <div class="col d-flex justify-content-center">{{ $workName[$type] }}</div>
                        @endforeach
                    </div>
                    <div class="row">
                        @foreach ($bdeWorkTypes as $type)
                            <div class="col d-flex justify-content-center ">
                                <div class="form-check form-switch">
                                    <input class="form-check-input @isset ($saveStatus['work_type']) is-valid @endisset" type="radio" value={{ $type }} wire:model.live = "wdr.work_type">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <x-spinner target='wdr.work_type' />
                <hr>
            </div>
            {{-- CAR --}}
            @livewire('domain.bde.add-comapny-vehicle-to-report',[
                'dailyWorkReport' => $dailyWorkReport,
            ])
            
            {{-- WORKER ATTENDANCE --}}
            <div>
                <h1 class="h6"><b>Prisustvo radnika</b></h1>
                <div class="row align-items-center">
                    <div class="col d-flex justify-content-center">
                        <i class="bi bi-people-fill" style="color: red;"></i>&nbsp : &nbsp
                        <b style="color: red;">0</b>
                    </div>
                    <div class="col d-flex justify-content-center"> 
                        <button class="btn btn-success" wire:click='selectModule("attendance")'><i class="bi bi-person-plus"></i></button></div>
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

            {{-- DELETE THIS WORK REPORT --}}
            <div class="col d-flex justify-content-center"> 
                <button class="btn btn-danger " style="width: 175px" wire:click='deleteWorkReport()'>
                    <i class="bi bi-trash"></i> OBRIŠI ZAPIS
                </button>
            </div>
        @else
            @livewire('domain.bde.main-work-report-modules.'.$module.'.'.$module, [
                'wdr' => $wdr,
            ])  
        @endif
        
    </x-cards.card>
</div>
