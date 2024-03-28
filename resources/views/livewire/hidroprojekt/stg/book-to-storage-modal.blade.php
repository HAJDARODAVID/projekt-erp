<div>

    <button type="submit" class="btn btn-success" wire:click='modalBtn(1)'><i class="bi bi-person-add"></i></button>

    <div class="modal modal-lg" id="bookToStorageModal" style="display:  @if ($activeModal) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Knjiženje materijala na stanje skladišta</h5>
                </div>
                <div class="modal-body">
                    @for ($i = 1; $i <= $itemCount; $i++)
                        <div class="row mb-2">
                            <div class="col col-md-8">
                                <div class="form-group">
                                    <label for="material">Materijal</label>
                                    <select class="form-control" id="material" wire:model.change='bookingOrder.{{ $i }}.mat_id'>
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
                                    <input type="text" class="form-control" id="qty" wire:model.live='bookingOrder.{{ $i }}.qty'>
                                </div>
                            </div>
                            <div class="col col-md-2 d-flex align-items-center">
                                <button type="submit" class="btn btn-danger"  wire:click='removeItem("{{ $i }}")'>-</button>
                            </div>
                        </div> 
                    @endfor

                    <div class="row">
                        <div class="col"></div>
                    </div>
                    
                    <button type="submit" class="btn btn-success mt-2" wire:click='addItem()'>+</button>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click='modalBtn(0)'>Zatvori</button>
                    <button type="button" class="btn btn-primary">PROKNJIŽI</button>
                </div>
            </div>
        </div>
    </div>

</div>
