<div>
    <div class="form-group mb-2">
        <label for="exampleFormControlTextarea1">Dnevnik radova</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" wire:model.blur="log"></textarea>
    </div>
    <div class="row"> 
        <div class="col d-flex justify-content-center">
            <button type="submit" class="btn btn-success" wire:click.prevet="saveLog()">SPREMI</button>
        </div>
    </div>
</div>
