<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <button class="btn btn-primary btn-lg d-flex align-items-center" wire:click='modalBtn(1)'><i class="bi bi-shop"></i></button>

    <x-modal :show='$show' :footer='false'>
        <x-slot name="mainTitle">Pružatelji usluga</x-slot>
        <x-slot name='headerBtn'> 
            <button class="btn btn-dark btn-sm" wire:click='modalBtn(0)' wire:loading.attr='disabled'>X</button>
        </x-slot>

        {{-- CONTAINER FOR SUCCESS ALERT --}}
        <div class="alert alert-success" role="alert" style="display: @if($showSuccessCard) block @else none @endif">
            Uspješno pohranjen poslužitelj!
        </div>

        {{-- CONTAINER FOR DANGER ALERT --}}
        @isset($error['message'])
            <div class="alert alert-danger" role="alert">
                {{ $error['message'] }}
            </div> 
        @endisset

        <div class="form-group d-flex">  
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Naziv novog poslužitelja" wire:model.blur='provider'>
            </div>
            <button class="btn btn-success mx-2" wire:loading.attr='disabled' wire:click='saveProvider()'><i class="bi bi-floppy"></i></button>    
        </div>
        <hr>
        <livewire:hidroProjekt.costs.bill-providers-table theme="bootstrap-5" />
    </x-modal>

    
</div>
