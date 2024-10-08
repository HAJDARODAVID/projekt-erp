<div>
    <button class="btn btn-success btn-sm" wire:click='toggleModal()'><i class="bi bi-plus-circle"></i></button>
    <x-modal :show='$show' :blur='TRUE'>
        <x-slot name='headerBtn'>
            <button class="btn btn-dark btn-sm" wire:click='toggleModal()' wire:loading.attr='disabled'>X</button>
        </x-slot>
        <x-slot name="mainTitle">NOVI ZADATAK</x-slot>

        <div class="form-group mb-2">
            <label>Naziv zadatka:</label>
            <input type="text" class="form-control" wire:model.blur='data.task'>
        </div>

        <div class="form-group mb-2">
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

    </x-modal>
</div>
