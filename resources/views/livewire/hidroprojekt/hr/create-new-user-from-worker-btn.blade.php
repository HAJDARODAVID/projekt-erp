<div>
    @if ($hasUser) 
        <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-person-add" wire:click='setActiveModal()' ></i></button>
    @else 
        <button type="submit" class="btn btn-success btn-sm" disabled><i class="bi bi-person-check-fill"></i></button>
    @endif

    <!-- Modal -->
    <div class="modal" id="createNewUserFromWorker-{{ $worker->id }}" style="display:  @if ($activeModal) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kreiraj novog korisnika za: {{ $worker->firstName }} {{ $worker->lastName }}</h5>
            </div>
            <div class="modal-body">
                <form  id="createNewUserFromWorkerForm" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-2">
                      <label for="email">E-mail poslovođe</label>
                      <input type="text" class="form-control" wire:model.blur='email' required>
                    </div>
                    <hr>           
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click='unSetActiveModal()' >Zatvori</button>
                <button type="button" class="btn btn-primary" wire:click='createUser()' @if($disableCreateBtn) disabled @endif>KREIRAJ KORISNIKA!</button>
            </div>
            </div>
        </div>
    </div>
    <script>
        function showModal(modal) {
            document.getElementById(modal).style.display = 'block';
        }
        function closeModal(modal) {
            document.getElementById(modal).style.display = 'none';
        }
        function submitForm(form){
            event.preventDefault();
            document.getElementById(form).submit();
        }
    </script>
    
    
</div>
