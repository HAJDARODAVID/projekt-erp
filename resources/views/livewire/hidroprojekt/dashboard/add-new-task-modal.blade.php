<div>
    <button class="btn btn-success btn-sm" wire:click='toggleModal()'><i class="bi bi-plus-circle"></i></button>
    <x-modal :show='$show' :blur='TRUE'>
        <x-slot name='headerBtn'>
            <button class="btn btn-dark btn-sm" wire:click='toggleModal()' wire:loading.attr='disabled'>X</button>
        </x-slot>
        <x-slot name="mainTitle">NOVI ZADATAK</x-slot>

        <div class="form-group mb-2">
            <label>Naziv zadatka:</label>
            <input type="text" class="form-control @isset($error['task']) is-invalid @endisset" wire:model.blur='data.task'>
        </div>

        <div class="form-group mb-3">
            <div class="row">
                <div class="col">
                    <label>Termin:</label>
                    <input type="date" class="form-control" wire:model.change='data.deadline'>
                </div>
                <div class="col">
                    <label for="priority">Odaberi prioritet:</label>
                    <select class="form-select" wire:model.change='data.priority'>
                        @foreach ($priorityOptions as $key => $option)
                            <option value="{{ $key }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        @if (app('user_rights')->hasRight('can-assign-task-to-others'))
            <div class="pt-2">
                <p class="text-primary mb-0"><b>DODIJELI RADNIKU</b></p>
            </div>
            <div class="form-group mt-1">
                <div class="row">
                    <div class="col">
                        <label for="priority">Odaberi radnika:</label>
                        <select class="form-select" wire:model.change='fromTo'>
                            <option value="NULL">...</option>
                            @foreach ($userFor as $key => $userName)
                                <option value="{{ $key }}">{{ $userName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        @endif 

        <x-slot name='footerItems'>
            <button class="btn btn-success" wire:click='saveItem()' wire:loading.attr='disabled'><i class="bi bi-floppy"></i></button>
        </x-slot>

    </x-modal>
</div>
