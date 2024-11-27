<div>
    <h1 class="h5"><b class="">Radni sati [kooperanti]</b></h1>
    <hr class="m-0 p-0 py-1">

    @foreach ($subcontractors as $contractorName => $contractor)
        <x-cards.card-collapsible>
            <x-slot:title>{{ $contractorName }}</x-slot:title>
            @foreach ($contractor as $workerID => $worker)
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">{{ $workerID }}-{{ $worker['name'] }}</div>
                    <div class="d-flex gap-1">
                        <input type="number" class="form-control form-control-sm @isset($saveState[$workerID]) is-valid @endisset" style="width: 65px" 
                        wire:model.blur='subcontractors.{{ $contractorName }}.{{ $workerID }}.hours'>
                        <button class="btn btn-danger btn-sm p-0 m-0 px-1" wire:click="removeAttendance({{ $workerID }}, '{{ $contractorName }}')"><i class="bi bi-trash"></i></button>
                    </div>  
                </div>
                <hr class="p-0 m-0 my-2">
            @endforeach
        </x-cards.card-collapsible>
    @endforeach
</div>
