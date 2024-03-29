<div>
    <b>Bolovanje</b>
    <div class="row">
        <div class="col">
            <div class="form-group mb-2">
                <label for="date">Od:</label>
                <input type="date" class="form-control @error('start_date')is-invalid @enderror" wire:model.live='dates.startDate'>
            </div>
        </div>
        <div class="col">
            <div class="form-group mb-2">
                <label for="date">Do:</label>
                <input type="date" class="form-control @error('start_date')is-invalid @enderror" wire:model.live='dates.endDate'>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-2">
        <button class="btn btn-success" style="width: 150px" wire:click.prevent='createNewSickLeave()'>SPREMI</button>
    </div>
</div>
