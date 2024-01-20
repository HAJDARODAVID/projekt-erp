<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="row" style="width: 120px">Ime prezime</th>
                <td>Sati</td>
            </tr>
        </thead>
        <tbody>
            <form>
            @foreach ($allWorkers as $worker)
                <tr>
                    <td>{{ $worker->getWorkerInfo->firstName }} {{ $worker->getWorkerInfo->lastName }}</td>
                    <td>
                        @if($worker->absence_reason)    
                            <div style="margin-right:30px; display:inline">
                                <b>{{$absenceReasonShtTxt[$worker->absence_reason]}}</b>
                            </div>
                        @else
                            <input wire:model.blur='workHours.{{ $worker->worker_id }}' class="form-control " type="number" style="display: inline;width: 50px" >   
                        @endif
                        
                        <button wire:click.prevent='addAbsenceReason("GO",{{ $worker->worker_id }})' class="btn btn-info btn-sm" style="display: inline">GO</button>
                        <button wire:click.prevent='addAbsenceReason("BO",{{ $worker->worker_id }})'class="btn btn-warning btn-sm" style="display: inline">BO</button>
                        <button wire:click.prevent='removeWorker({{ $worker->worker_id }})' class="btn btn-danger btn-sm" style="display: inline">X</button>
                    </td>
                </tr>
            @endforeach
            </form>
        </tbody>
    </table>
</div>
