<div>
    <x-modal  :show=$showModal :blur='TRUE' :footer='FALSE'>
        <x-slot name="mainTitle">@isset($matInfo){{ $matInfo->id}} @endisset </x-slot>
        <x-slot name="secTitle">@isset($matInfo){{ $matInfo->name}} @endisset </x-slot>
        <x-slot name='headerBtn'> 
            <button class="btn btn-dark btn-sm" wire:click='modalBtn(0)' wire:loading.attr='disabled'>X</button>
        </x-slot>

        <div >
            <div class="d-flex justify-content-center"><h5>KOLIČINA</h5></div>
            <div class="d-flex justify-content-center mt-2">
                <input type="number" class="form-control form-lg @if($invalid) is-invalid @endif" style="width: 150px" wire:model.live='qty' id='qr-input'>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-success btn-lg d-flex align-items-center mx-1" wire:click='addItemToInventoryList()'><i class="bi bi-floppy"></i></button>
            </div>
            
        </div>
    </x-modal>

</div>
