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
                    <td>{{ $stock->getMaterialInfo->name }} [{{ $stock->getMaterialInfo->uom_1 }}]</td>
                    <td>{{ $stock->qty }}</td>
                    <td><input type="number" class="form-control form-control-sm" style="width: 50px" wire:model.blur='items.{{ $stock->mat_id }}'></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <button class="btn btn-success" wire:click="sendToConsumption()" wire:confirm="Upisane količine su ispravne i potrošene?">SPREMI</button>
    </div>
    
</div>
