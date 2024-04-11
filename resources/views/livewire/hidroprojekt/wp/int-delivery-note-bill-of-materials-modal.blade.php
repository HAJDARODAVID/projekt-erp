<div>
    <button class="btn btn-success btn-sm" wire:click='modalBtn(1)'><i class="bi bi-file-text"></i></button>

    <div class="modal modal-lg" id="bookToStorageModal" style="display:  @if ($activeModal) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Otpremnica: #{{ $row->id }}</h5>
                </div>
                <div class="modal-body">
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 100px">Izdavatelj:</td>
                                <td>{{ $matDoc->getUserInfo->getWorker->firstName }} {{ $matDoc->getUserInfo->getWorker->lastName }}</td>
                            </tr>
                            <tr>
                                <td>Gradilište:</td>
                                <td>{{ $constSite->name }}</td>
                            </tr>
                            <tr>
                                <td>Vrsta:</td>
                                <td>{{ $bookingType }}</td>
                            </tr>
                            <tr>
                                <td>Datum:</td>
                                <td>{{ $matDoc->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <div class="container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td style = "width: 80px"><b>#</b></td>
                                    <td style = "width: 300px"><b>Materijal</b></td>
                                    <td style = "width: 50px"><b>QTY</b></td>
                                    <td style = "width: 50px"><b>UOM</b></td>
                                    <td style = "width: 150px"><b>Iznos[€]</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deliveryNoteBOM as $bom)
                                    <tr>
                                        <td>{{ $bom->mat_id }}</td>
                                        <td>{{ $bom->getMaterialInfo->name }}</td>
                                        <td>{{ $bom->qty }}</td>
                                        <td>{{ $bom->getMaterialInfo->uom_1 }}</td>
                                        <td>{{  number_format($bom->qty * $bom->getMaterialInfo->price,2) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>{{  number_format($overAllValue,2) }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click='modalBtn(0)'>Zatvori</button>
                </div>
            </div>
        </div>
    </div>
</div>
