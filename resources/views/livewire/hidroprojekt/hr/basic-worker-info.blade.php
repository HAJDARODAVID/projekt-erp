<div>
    <h1 class="h6">Osnovne informacije</h1>
    <div class="row mt-2">
        <div class="col">
            <div class="row">
                <div class="col-lg">
                    <div class="form-group mb-2">
                        <label for="firstName">Ime</label>
                        <input type="text" class="form-control @isset($saveState['firstName']) is-valid @endisset" wire:model.blur='worker.firstName'>
                    </div>
                    <div class="form-group">
                        <label for="work_place">Aktualno radno mjesto</label>
                        <input type="text" class="form-control @isset($saveState['working_place']) is-valid @endisset" wire:model.blur='worker.working_place'>
                    </div>
                </div>
                <div class="col-lg">
                    <div class="form-group mb-2">
                        <label for="lastName">Prezime</label>
                        <input type="text" class="form-control @isset($saveState['lastName']) is-valid @endisset" wire:model.blur='worker.lastName'>
                    </div>
                    <div class="form-group">
                        <label for="oib">OIB</label>
                        <input type="text" class="form-control @isset($saveState['OIB']) is-valid @endisset" wire:model.blur='worker.OIB'>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col col-md-4">
                    <div class="form-group mb-2">
                        <label for="doe">Datum zapošljenja</label>
                        <input type="date" class="form-control @isset($saveState['doe']) is-valid @endisset" wire:model.blur='worker.doe'>
                    </div>
                    <div class="form-group">
                        <label for="ced">Istek ugovora</label>
                        <input type="date" class="form-control @isset($saveState['ced']) is-valid @endisset" wire:model.blur='worker.ced'>
                    </div>
                </div>
                <div class="col">
                    <label for="ced">Komentar</label>
                    <textarea class="form-control @isset($saveState['comment']) is-valid @endisset" rows="4" style="resize: none;" wire:model.blur='worker.comment'></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
