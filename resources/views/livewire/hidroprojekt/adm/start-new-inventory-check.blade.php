<div>
    <button class="btn btn-success" wire:click='modalBtn(1)'>POKRENI NOVU INVENTURU</button>

    <div class="modal" id="openNewInventoryCheck" style="display:  @if ($activeModal) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">INVENTURA</h5>
                </div>
                <div class="modal-body">
                    <h6>Da li želite pokrenuti inventuru: {{ $newInventoryCheckName }}?</h6>
                    
                    <table>
                        <tr>
                            <td style="width: 65px">Korisnik:</td>
                            <td>{{ $info['user']->firstName }} {{ $info['user']->lastName }}</td>
                        </tr>
                        <tr>
                            <td>Datum:</td>
                            <td>{{ $info['date'] }}</td>
                        </tr>
                    </table>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" wire:click='openNewInventoryCheck()' onclick="this.setAttribute('disabled', true)">POKRENI</button>

                    <button type="button" class="btn btn-secondary" wire:click='modalBtn(0)'>ZATVORI</button>
                </div>
            </div>
        </div>
    </div>
</div>
