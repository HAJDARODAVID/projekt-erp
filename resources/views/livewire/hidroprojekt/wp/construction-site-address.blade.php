<div class="row mb-2">
    <div class="form-group col">
        <label for="street">Ulica</label>
        <input type="text" class="form-control @error('street')is-invalid @enderror" wire:model.blur='address.street'>
    </div>
    <div class="form-group col">
        <label for="town">Mjesto</label>
        <input type="text" class="form-control @error('town')is-invalid @enderror" wire:model.blur='address.town'>
    </div>
    <div class="form-group col-2">
        <a class="btn btn-success mt-3" href="https://www.google.com/maps/place/{{$address['street'] . ' ' . $address['town']}}"><i class="bi bi-geo-alt"></i></a>
    </div>
</div>
