<div>

    <button type="submit" class="btn btn-success" wire:click='modalBtn(1)'><i class="bi bi-building-add"></i></button>

    <div class="modal modal-lg" id="bookToStorageModal" style="display:  @if ($activeModal) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Knjiženje materijala na stanje gradilišta</h5>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="constId">Gradilište</label>
                                <select class="form-control @isset($error['constId']) is-invalid @endisset" id="constId" wire:model.change='constId'>
                                    <option value="0">...</option> 
                                    @foreach ($constInfo as $constNr => $constName)
                                        <option value="{{ $constNr }}">{{ $constName }}</option>    
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                    </div>
                    <hr>

                    @foreach ($bookingOrder as $key => $item)
                        <div class="row mb-2">
                            <div class="col col-md-6">
                                <div class="form-group">
                                    <label for="material">Materijal</label>
                                    <select class="form-control @isset($error[$key]['mat_id']) is-invalid @endisset" id="material" wire:model.change='bookingOrder.{{ $key }}.mat_id'>
                                        <option value="0">...</option> 
                                        @foreach ($stockInfo as $stock)
                                            <option value="{{ $stock->mat_id }}">{{ $stock->getMaterialInfo->name }}</option>    
                                        @endforeach
                                    </select>
                                </div>  
                            </div>
                            <div class="col col-md-2">
                                <div class="form-group">
                                    <label for="available">Dostupno</label>
                                    <input type="text" class="form-control" id="available" wire:model.live='availableQty.{{ $key }}' disabled>
                                </div>
                            </div>
                            <div class="col col-md-2">
                                <div class="form-group">
                                    <label for="qty">QTY</label>
                                    <input type="text" class="form-control @isset($error[$key]['qty']) is-invalid @endisset" id="qty" wire:model.live='bookingOrder.{{ $key }}.qty'>
                                </div>
                            </div>
                            <div class="col col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-danger"  wire:click='removeItem("{{ $key }}")'>-</button>
                            </div>
                        </div> 
                    @endforeach

                    <div class="row">
                        <div class="col"></div>
                    </div>
                    
                    <button type="submit" class="btn btn-success mt-2" wire:click='addItem()'>+</button>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click='modalBtn(0)'>Zatvori</button>
                    <button type="button" class="btn btn-primary" wire:click='bookToStorage()' onclick="this.setAttribute('disabled', true)">PROKNJIŽI</button>
                </div>
            </div>
        </div>
    </div>

</div>
