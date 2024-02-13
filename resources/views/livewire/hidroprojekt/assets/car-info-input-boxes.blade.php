<div class="col">
    <div class="col">
        <h1 class="h6">Informacije o vozilu</h1>
        <div class="row mb-3">
            <div class="col">
                <div class="form-group">
                    <label for="car_plates">Registracijske oznake</label>
                    <input type="text" class="form-control" id="car_plates" name="car_plates"  wire:model.blur = 'carInfo.car_plates'>
                </div> 
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="valid_to">Registriran do:</label>
                    <input type="date" class="form-control" id="valid_to" name="valid_to" wire:model.blur = 'carInfo.valid_to'>
                </div> 
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="form-group">
                    <label for="brand">Marka</label>
                    <input type="text" class="form-control" id="brand" name="brand" wire:model.blur = 'carInfo.brand'>
                </div> 
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" id="model" name="model" wire:model.blur = 'carInfo.model'>
                </div> 
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="form-group">
                    <label for="last_service_at">Zadnji servis(km)</label>
                    <input type="text" class="form-control" id="last_service_at" name="last_service_at" disabled wire:model.blur = 'carInfo.last_service_at'>
                </div> 
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="service_every">Servis svakih(km)</label>
                    <input type="text" class="form-control" id="service_every" name="service_every" wire:model.blur = 'carInfo.service_every'>
                </div> 
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="dop">Godište</label>
                    <input type="text" class="form-control" id="dop" name="dop" wire:model.blur = 'carInfo.dop'>
                </div> 
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="purchase_price">Nabavna cijena</label>
                    <input type="text" class="form-control" id="purchase_price" name="purchase_price" wire:model.blur = 'carInfo.purchase_price'>
                </div> 
            </div>
        </div> 
    </div>
</div>
