<div class="d-flex gap-1">
    <button class="btn btn-success btn-lg" wire:click='openModal(1)'><i class="bi bi-collection"></i></button>
    <button class="btn btn-success btn-lg" wire:click='openModal(2)'><i class="bi bi-gear"></i></button>

    <x-modal :show=$show :blur='TRUE' :footer='FALSE'>
        <x-slot name="mainTitle">{{ $title }}</x-slot>
        <x-slot name='headerBtn'> 
            <button class="btn btn-dark btn-sm" wire:click='openModal(0)' wire:loading.attr='disabled'>X</button>
        </x-slot>

        <div class="form-group mb-3">
            <label>New role/resource name </label>
            <input type="text" class="form-control" wire:model.blur='new'>
        </div>
        <div class="d-flex justify-content-center">
            <button class="btn btn-success btn-lg" wire:click='save()'><i class="bi bi-floppy"></i></button>
        </div>
    </x-modal>
</div>
