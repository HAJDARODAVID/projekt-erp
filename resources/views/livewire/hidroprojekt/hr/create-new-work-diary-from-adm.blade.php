<div>
    <button class="btn btn-success btn-lg d-flex align-items-center" wire:click='modalToggle()'>
        <i class="bi bi-building-add"></i>
    </button>

    <x-modal :show=$show :blur=TRUE>
        <x-slot name="mainTitle">Novi zapis dnevnika rada</x-slot>
        <x-slot name='headerBtn'> 
            <button class="btn btn-dark btn-sm" wire:click='modalToggle()' wire:loading.attr='disabled'>X</button>
        </x-slot>

        <div class="row mb-2">
            <div class="col">
                <label for="">Datum</label>
                <input type="date" class="form-control @isset($error['date']) is-invalid @endisset" wire:model.live='date'>
            </div>
            <div class="col">
                <label for="">Poslovođa</label>
                <select class="form-control" wire:model.change='selectedLeader'>
                    <option value="">...</option>
                    @isset($leaders)
                        @foreach ($leaders as $leader)
                            <option value="{{ $leader->id }}">{{ $leader->getWorker->fullName }}</option>   
                        @endforeach   
                    @endisset
                </select>
            </div>
        </div>
        <label for="">Gradilište</label>
        <select class="form-control mb-2 @isset($error['constSite']) is-invalid @endisset" wire:model.change='constSite'>
            <option value="">...</option>
            @isset($jobSites)
                @foreach ($jobSites as $jobSite)
                    <option value="{{ $jobSite->id }}">{{ $jobSite->name }}</option>   
                @endforeach   
            @endisset
        </select>
        <label>Vrsta terena</label>
        <div class="form-check form-switch">
            <input class="form-check-input" type="radio" value="1" wire:model='jobType'>
            <label class="form-check-label">Doma</label>
          </div>
          <div class="form-check form-switch">
            <input class="form-check-input" type="radio" value="2" wire:model='jobType'>
            <label class="form-check-label">Teren</label>
        </div>
        <hr>
        <div class="col-md mb-3 rounded shadow border px-0" style="background-color: rgb(252, 252, 252)">
            <div class="d-flex justify-content-between align-items-center rounded-top shadow" style="background-color: rgb(236, 236, 236);height:40px">
                <div class="h7 px-4" style="color: rgb(102, 121, 146)">
                    <b>{{ strtoupper("Popis radnika u prisustvu") }}</b>
                </div>
            </div>
            <div class="py-3 px-4 overflow-auto">
                <div class="">
                    <div class="d-flex gap-1">
                        <input type="text" class="form-control" placeholder="Ime/prezime radnika"
                     wire:model.live.debounce.250ms='workerSearch'>
                        @if ($workers)
                            <button class="btn btn-danger btn-sm" wire:click='emptySearch()'>
                                <i class="bi bi-trash"></i>
                            </button>
                        @endif
                    </div>
                    @isset($workers)
                    <div class="d-flex flex-wrap gap-2 my-2">
                        @foreach ($workers as $worker)
                        <button type="button" class="btn btn-secondary btn-sm" wire:click='addToAttendance({{ $worker->id }})'>
                            {{ $worker->fullName }}
                        </button>
                        @endforeach   
                    </div>
                    @endisset
                    <hr>
                    @if (!empty($attendance))
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Radnik</th>
                                    <th>Sati</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendance as $key => $att)
                                    <tr>
                                        <td>{{ $att['worker'] }}</td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm @isset($error['att'][$att['id']]) is-invalid @endisset" style="width: 70px" wire:model.blur='attendance.{{ $key }}.hours'>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" wire:click='removeFromAtt({{ $key }})'>
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>  
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div> 
        </div>

        <x-slot name='footerItems'>
            <button class="btn btn-success" wire:click='save()'><i class="bi bi-floppy"></i></button>
        </x-slot>

    </x-modal>
</div>
