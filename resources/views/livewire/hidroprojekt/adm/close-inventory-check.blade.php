<div>
    <button class="btn btn-danger" wire:click='modalBtn(1)'>ZATVORI INVENTURU: {{ $activeInventory->inv_name }}</button> 

    <div class="modal" id="closeInventoryCheck" style="display:  @if ($activeModal) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content">
                    <h5 class="modal-title" id="exampleModalLabel">INVENTURA: {{ $activeInventory->inv_name }}</h5>
                    <div>
                        <button class="btn btn-dark btn-sm" wire:click='modalBtn(0)' wire:loading.attr='disabled'>X</button>
                    </div>
                </div>
                <div class="modal-body">
                    <h6>Da li želite proknjižiti ili stornirati inventuru?</h6>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" wire:click='openNewInventoryCheck()' onclick="this.setAttribute('disabled', true)">KNJIŽENJE INVENTURE</button>

                    <button type="button" class="btn btn-secondary" wire:click='canceledInventoryCheck()' onclick="this.setAttribute('disabled', true)">STORNO</button>
                </div>
            </div>
        </div>
    </div>
</div>
