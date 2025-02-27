<div>
    <div class="col-md mb-3 rounded shadow border px-0 mt-2" style="background-color: rgb(252, 252, 252)">
        <div class="d-flex justify-content-between align-items-center rounded-top shadow" style="background-color: rgb(236, 236, 236);height:40px">
            <div class="h7 px-4" style="color: rgb(102, 121, 146)">
                <b>{{ mb_strtoupper("traži / dodaj radnika", 'UTF-8') }}</b>
            </div>
            <div class="px-4">
                @if($attendance)
                    <button class="btn btn-success btn-sm" wire:click='save()'>
                        <i class="bi bi-floppy"></i>
                    </button>
                @endif
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
</div>
