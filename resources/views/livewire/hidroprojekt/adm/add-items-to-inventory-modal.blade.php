<div>
    <button class="btn btn-primary btn-lg d-flex align-items-center mx-1" wire:click='modalBtn(1)'>
        <i class="bi bi-plus-circle"></i>
    </button>

    <div class="modal modal-lg" id="bookToStorageModal" style="display:  @if ($modalStatus) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        DODAVANJE MATERIJALA NA INVENTURU
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="material">Lokacija</label>
                        <select class="form-control @isset($error['location']) is-invalid @endisset" id="location" wire:model.change='location'>
                            <option value="main_storage">Skladište [Firma]</option> 
                            @foreach ($constSites as $constSite)
                                <option value="{{ $constSite->id }}">{{ $constSite->name }}</option>    
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    @foreach ($inventoryItems as $key => $item)
                        <div class="row mb-2">
                            <div class="col col-md-8">
                                <div class="form-group">
                                    <label for="material">Materijal</label>
                                    <select class="form-control @isset($error[$key]['mat_id']) is-invalid @endisset" id="material" wire:model.change='inventoryItems.{{ $key }}.mat_id'>
                                        <option value="0">...</option> 
                                        @foreach ($mmInfo as $matNr => $matName)
                                            <option value="{{ $matNr }}">{{ $matName }}</option>    
                                        @endforeach
                                    </select>
                                </div>  
                            </div>
                            <div class="col col-md-2">
                                <div class="form-group">
                                    <label for="qty">QTY</label>
                                    <input type="text" class="form-control @isset($error[$key]['qty']) is-invalid @endisset" id="qty" wire:model.live='inventoryItems.{{ $key }}.qty'>
                                </div>
                            </div>
                            <div class="col col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-danger"  wire:click='removeItem("{{ $key }}")'>-</button>
                            </div>
                        </div> 
                    @endforeach

                    {{-- <div class="row">
                        <div class="col"></div>
                    </div> --}}

                    <button type="submit" class="btn btn-success mt-2" wire:click='addItem()'>+</button>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click='modalBtn(0)'>Zatvori</button>
                    <button type="button" class="btn btn-primary" wire:loading.attr="disabled"
                    wire:click='addToInventory()'>DODAJ</button>
                </div>
            </div>
        </div>
    </div>
</div>
