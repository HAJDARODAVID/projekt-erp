<div>
    @if ($type == 'bde')
        <a class="dropdown-item" href="#" onclick="showModal('changePassword')">Promjeni lozinku</a>   
    @endif

    <div class="modal" id="changePassword">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Promjeni lozinku</h5>
            </div>
            <div class="modal-body">
                <form  id="changePasswordForm" method="POST">
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
                <button type="button" class="btn btn-secondary" onclick="closeModal('changePassword')">Zatvori</button>
                <button type="button" class="btn btn-primary">KREIRAJ KORISNIKA!</button>
            </div>
            </div>
        </div>
    </div>

    <script>
        function showModal(modal) {
            event.preventDefault();
            document.getElementById(modal).style.display = 'block';
        }
        function closeModal(modal) {
            event.preventDefault();
            document.getElementById(modal).style.display = 'none';
        }
        function submitForm(form){
            event.preventDefault();
            document.getElementById(form).submit();
        }
    </script>
    
</div>