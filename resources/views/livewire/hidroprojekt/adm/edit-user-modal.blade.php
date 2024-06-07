<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <button class="btn btn-primary btn-sm" 
        wire:click='modalBtn(1)' 
        wire:loading.attr='disabled' 
    >
        UREDI
    </button>

    <div class="modal" id="editUser" style="display:  @if ($modalStatus) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content">
                    <div>
                        <h5 class="modal-title" id="exampleModalLabel">
                            Uređivanje korisnika: {{ $row->name }}
                        </h5>
                    </div>
                    <div>
                        <button class="btn btn-dark btn-sm" wire:click='modalBtn(0)' wire:loading.attr='disabled'>X</button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        @if (!$row->active)
                            <button class="btn btn-success"
                            wire:click='activateUser()' 
                            wire:loading.attr='disabled' >
                                AKTIVIRAJ!
                            </button>   
                        @endif
                        @if ($row->active)
                            <button class="btn btn-success"
                            wire:click='resetPassword()' 
                            wire:loading.attr='disabled' >
                                RESET LOZINKE!
                            </button>   
                        @endif
                    </div>

                    <div class="form-group mb-2">
                        <label>Korisnik</label>
                        <input type="text" class="form-control" wire:model.blur='data.name'>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <div class="form-group">
                                <label>Ime</label>
                                <input type="text" class="form-control" wire:model='workerInfo.firstName' disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Prezime</label>
                                <input type="text" class="form-control" wire:model='workerInfo.lastName' disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label>E-mail</label>
                        <input type="email" class="form-control" wire:model.blur='data.email'>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <x-processing-modal target='activateUser, resetPassword'></x-processing-modal>
</div>
