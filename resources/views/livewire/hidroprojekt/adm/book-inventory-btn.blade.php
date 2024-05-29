<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <button class="btn btn-success btn-lg d-flex align-items-center mx-1" 
        wire:click='bookInventory()' 
        wire:loading.attr='disabled' 
        wire:confirm.prompt="Da li želite završiti inventuru?\n\nUpiši 'HIDRO-PROJEKT' kako bi potvrdio knjiženje|HIDRO-PROJEKT"
    >
        <i class="bi bi-check-lg"></i>
    </button>

    {{-- Loadnig spinner --}}
    <div class="modal modal-sm" id="spinner" wire:loading>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">
                        Processing...
                    </h6>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center" >
                        <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
