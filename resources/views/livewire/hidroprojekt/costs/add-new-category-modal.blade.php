<div>
    <button class="btn btn-primary btn-lg d-flex align-items-center" wire:click='modalBtn(1)'><i class="bi bi-list-ul"></i></button>

    <x-modal :show='$show' :footer='false' :blur='TRUE'>
        <x-slot name="mainTitle">Kategorije</x-slot>
        <x-slot name='headerBtn'> 
            <button class="btn btn-dark btn-sm" wire:click='modalBtn(0)' wire:loading.attr='disabled'>X</button>
        </x-slot>

        {{-- CONTAINER FOR SUCCESS ALERT --}}
        <div class="alert alert-success" role="alert" style="display: @if($showSuccessCard) block @else none @endif">
            Uspješno pohranjena kategorija!
        </div>

        {{-- CONTAINER FOR DANGER ALERT --}}
        @isset($error['message'])
            <div class="alert alert-danger" role="alert">
                {{ $error['message'] }}
            </div> 
        @endisset

        <div class="form-group d-flex">  
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Naziv nove kategorije" wire:model.blur='category'>
            </div>
            <button class="btn btn-success mx-2" wire:loading.attr='disabled' wire:click='saveCategory()'><i class="bi bi-floppy"></i></button>    
        </div>
        <hr>
        <livewire:hidroProjekt.costs.bill-categories-table theme="bootstrap-5" />
    </x-modal>
</div>
