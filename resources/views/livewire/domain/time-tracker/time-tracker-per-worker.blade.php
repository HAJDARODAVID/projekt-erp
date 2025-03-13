<div class="d-flex flex-column flex-grow-1 px-3">
    <div class="row flex-grow-1">
        <div class="col-md-2 d-flex flex-column py-2" style="padding-right: 5px">
            <x-ui.card.basic-card :search=TRUE searchModel='workerSearch' :overflow=TRUE>
                <x-slot name='title'>Radnici</x-slot>
                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0;overflow: auto; padding: 10px; margin-top: 50px">
                    <ul class="list-group">
                        @foreach ($workerList as $worker)
                            <li class="list-group-item list-group-item-action @if($worker->id == $selectedWorker)active @endif" 
                                style="cursor: pointer" 
                                wire:click='selectWorker({{ $worker->id }})'
                            >
                                    {{ $worker->fullName }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                
            </x-ui.card.basic-card>
        </div>
        <div class="col-md d-flex flex-column py-2" style="padding-right: 5px">
            @livewire('domain.time-tracker.time-tracker-worker-info-container',[
                'worker' => $selectedWorker,
            ])
        </div>
    </div>
</div>