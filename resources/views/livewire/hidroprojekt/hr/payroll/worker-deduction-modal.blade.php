<div>
    <button class="btn btn-warning btn-lg d-flex align-items-center" wire:click='openCloseModal()'>
        <i class="bi bi-person-dash"></i>
    </button>

    <x-modal :show='$show'>
        <x-slot name='mainTitle'>Here goes custom title</x-slot>
        <x-slot name='headerBtn'>
            <button class='btn btn-dark btn-sm' wire:click='openCloseModal()'>X</button>
        </x-slot>
        
        {{-- BODY CONTEND --}}
        “ Well begun is half done. ”<br>
        — Aristotle
        
        <x-slot name='footerItems'>
            <button class='btn btn-success'>
                <i class="bi bi-floppy"></i>
            </button>
        </x-slot>
    </x-modal>
</div>
