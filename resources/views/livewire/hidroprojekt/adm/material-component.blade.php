<div>
    <b>OSNOVNI PODACI</b>
    <div class="form-group mb-3">
        <label for="name">Naziv materijala</label>
        <input type="text" class="form-control @isset($save['name']) is-valid @endisset @isset($error['name']) is-invalid @endisset" id="name" wire:model.blur='mmInfo.name' >
    </div>
    <div class="row mb-3">
        <div class="col">
            <div class="form-group">
                <label for="oem">Proizvođač</label>
                <input type="text" class="form-control @isset($save['oem']) is-valid @endisset @isset($error['oem']) is-invalid @endisset" id="oem" wire:model.blur='mmInfo.oem'>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="supplier">Dobavljač</label>
                <select class="form-control @isset($save['supplier_id']) is-valid @endisset @isset($error['supplier_id']) is-invalid @endisset" id="supplier_id" wire:model.change='mmInfo.supplier_id'>
                    <option value="0">...</option> 
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>    
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="uom_1">Mjerna jedinica</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            @isset($mmInfo['uom_1'])
                                {{ $mmInfo['uom_1'] }} 
                            @else
                                &nbsp;
                            @endisset
                        </div>
                    </div>
                    <select class="form-control @isset($save['uom_1']) is-valid @endisset @isset($error['uom_1']) is-invalid @endisset" id="uom_1" wire:model.change='mmInfo.uom_1'>
                            <option value="0">...</option> 
                        @foreach ($uom as $key => $u)
                            <option value="{{ $key }}">{{ $u }}</option>    
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <b>NABAVA</b>
    <div class="row mb-3">
        <div class="col">
            <div class="form-group">
                <label for="price">Cijena (bez PDV)</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">€</div>
                    </div>
                    <input type="number" class="form-control @isset($save['price']) is-valid @endisset @isset($error['price']) is-invalid @endisset" id="price" wire:model.blur='mmInfo.price'>
                </div>    
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="pricevat">Cijena (PDV)</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">€</div>
                    </div>
                    <input type="number" class="form-control" id="pricevat" wire:model='mmInfo.pricevat' disabled>
                </div>    
            </div>
        </div>
    </div>
    <b>PRODAJA</b>
    <div class="row mb-3">
        <div class="col">
            <div class="form-group">
                <label for="price">Prodajna cijena</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">€</div>
                    </div>
                    <input type="number" class="form-control @isset($save['s_price']) is-valid @endisset @isset($error['s_price']) is-invalid @endisset" id="price" wire:model.blur='mmInfo.s_price'>
                </div>    
            </div>
        </div>
        <div class="col"></div>
    </div>
    @if ($type =='new')
        <button class="btn btn-success" wire:click='saveBtn()' @if($inProgress) disabled @endIf onclick="this.setAttribute('disabled', true)">SPREMI</button>    
    @endif
</div>
