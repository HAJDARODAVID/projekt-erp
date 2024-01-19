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
                        <input wire:model.blur='workHours.{{ $worker->worker_id }}' class="form-control " type="number" style="display: inline;width: 50px" >
                        <button wire:click='addAbsenceReason("GO",{{ $worker->worker_id }})' class="btn btn-secondary btn-sm" style="display: inline">GO</button>
                        <button wire:click='addAbsenceReason("BO",{{ $worker->worker_id }})'class="btn btn-secondary btn-sm" style="display: inline">BO</button>
                        <button wire:click='removeWorker({{ $worker->worker_id }})' class="btn btn-danger btn-sm" style="display: inline">X</button>
                    </td>
                </tr>
            @endforeach
            </form>
        </tbody>
    </table>
</div>
