<div class="row mb-2">
    <div class="form-group col">
        <label for="start_date">Planirani početak radova</label>
        <input type="date" class="form-control @error('start_date')is-invalid @enderror" wire:model.blur='dates.start_date'>
    </div>
    <div class="form-group col">
        <label for="end_date">Planirani završetak radova</label>
        <input type="date" class="form-control @error('end_date')is-invalid @enderror" wire:model.blur='dates.end_date'>
    </div>
</div>
