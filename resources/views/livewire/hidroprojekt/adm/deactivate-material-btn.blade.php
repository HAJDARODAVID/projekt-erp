<div>
    <button class="btn btn-danger" wire:loading.attr='disabled' wire:click='deactivate()'  wire:confirm="Da li ste sigurni da želite maknuti material '{{ $mmInfo->name }}'?"><i class="bi bi-trash"></i></button>
</div>
