<div>
    
    <h1 class="h6"><b>Vrsta terena</b></h1>
    <div class="row" wire:loading.remove>
        <div class="col d-flex justify-content-center">Doma</div>
        <div class="col d-flex justify-content-center">Teren</div>
    </div>
    <div class="row" wire:loading.remove>
        <div class="col d-flex justify-content-center">
            <input type="checkbox" name="vales" id="" wire:model.live = "home">
        </div>
        <div class="col d-flex justify-content-center">
            <input type="checkbox" name="" id="" wire:model.live = "field">
        </div>
    </div>

    <div class="d-flex justify-content-center" >
        <div class="spinner-border" role="status" wire:loading>
            <span class="sr-only"></span>
        </div>
    </div>
    <hr>
</div>
