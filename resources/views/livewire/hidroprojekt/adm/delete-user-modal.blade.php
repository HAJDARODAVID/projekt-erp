<div>
    <button class="btn btn-danger btn-sm d-flex align-items-center"
        wire:click='deleteUser()' 
        wire:loading.attr='disabled' 
        wire:confirm="Da li želite izbrisati korisnika: {{ $row->name }}" 
    >
        <i class="bi bi-trash"></i>
    </button>
    
    {{-- Loadnig spinner modal --}}
    <x-processing-modal target='deleteUser'></x-processing-modal>
</div>
