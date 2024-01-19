<div>
    <tr>
        <td>{{ $worker->getWorkerInfo->firstName }} {{ $worker->getWorkerInfo->lastName }}</td>
        <td>
            <input wire:model.blur='workHours.{{ $this->worker->worker_id }}'  class="form-control " type="number" style="width: 50px" >
        </td>
    </tr>
</div>


