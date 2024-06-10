<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <div class="modal" id="bookToStorageModal" style="display:  @if ($activeModal) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-start">
                    @if ($coOpWorker)
                        <div>
                            <div><h5 class="h5">Radnik: {{ $coOpWorker->firstName }} {{ $coOpWorker->lastName }}</span></div>
                            <div><h7 class="h7">Grupa: {{ $coOpWorker->getCoOpInfo->name }}</span> </div>
                            <div><h7 class="h7">Datum: {{ $attendanceDate }}</span> </div>
                        </div>
                    @endif
                    <button class="btn btn-dark" wire:click='closeModal()'>X</button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <div class="gap-1">
                            <button class="btn btn-success" wire:click='setType(1)'><i class="bi bi-hammer"></i></button>
                            <button class="btn btn-success" wire:click='setType(2)'><i class="bi bi-cone-striped"></i></button>
                        </div>
                        @if ($attendance)
                            <button class="btn btn-danger d-flex align-items-center"
                                wire:click='delete()' 
                                wire:loading.attr='disabled'
                            ><i class="bi bi-trash"></i>
                            </button>
                        @endif
                        
                    </div>
                    
                    <hr>
                    
                    <div style="display: @if ($type == 'miscWork') block @else none @endif">
                        <b>Režijski sati:</b><br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td><b>Vrsta režija</b></td>
                                    <td><b>Sati</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Čret</td>
                                    <td>
                                        <input type="number" class="form-control" style="width: 100px" wire:model.blur='hours'>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div style="display: @if ($type == 'wdr') block @else none @endif">
                        <b>Dnevnik rada:</b>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" wire:click='save()' wire:loading.attr='disabled'>SPREMI</button>
                </div>
            </div>
        </div>
    </div>

    <x-processing-modal target='openModal, mount, save'></x-processing-modal>
</div>
