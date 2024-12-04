<div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="">
            <span class="h5"> <b>Evidencija potrošenog materijala</b> </span>
        </div>
        <div class="">
            <button class="btn btn-success" wire:click="sendToConsumption()" wire:confirm="Upisane količine su ispravne i potrošene?"><i class="bi bi-floppy"></i></button>
        </div>
    </div>
    <hr>

    <div class="" x-data="{ isVisible: $wire.entangle('consumptionStatus') }">
        <div class="alert alert-success p-0 p-2" x-show="isVisible" x-intersect="setTimeout(() => { isVisible = false }, 2500)" x-transition:enter.scale.80 x-transition:leave.scale.80>
            <p class="m-0">Uspješno evidentirana potrošnja!</p>
        </div>
    </div>

    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Materijal</th>
                    <th>QTY</th>
                    <th>Potrošeno</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($onStock as $stock)
                    <tr>
                        <td>{{ $stock->getMaterialInfo->name }}</td>
                        <td>{{ $stock->qty }}</td>
                        <td><input type="number" class="form-control form-control-sm @isset($saveState[$stock->mat_id]) is-valid @endisset" style="width: 70px" wire:model.blur='items.{{ $stock->mat_id }}'></td>
                    </tr>
                @endforeach
            </tbody>
        </table>        
    </div>

    <hr>
    <b>Potrošen materijal:</b>
    <table class="table table-sm">
        <thead>
            <tr>
                <th>Materijal</th>
                <th>QTY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($consumedMaterial as $mat => $qty)
                <tr>
                    <td>{{ $mat }}</td>
                    <td>{{ $qty }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>  
</div>
