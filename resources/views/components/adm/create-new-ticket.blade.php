<div>
    <button class="btn btn-success btn-sm" onclick="showModal('createNewTicketModal')">KREIRAJ NOVI TICKET</button>

    <!-- Modal -->
    <div class="modal" id="createNewTicketModal" style="display:  @if (Session::has('errors')) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Opis ticketa</h5>
            </div>
            <div class="modal-body">
                <form  id="createNewTicketForm" method="POST" action="{{ route('hp_newTicket') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-2">
                      <label for="ticketName">Naslov</label>
                      <input type="text" class="form-control @error('ticketName')is-invalid @enderror" id="ticketName" name="ticketName" required>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="form-group col">
                            <label for="job_description">Opis potrebnih promjena</label>
                            <textarea class="form-control @error('job_description')is-invalid @enderror" id="job_description" rows="4" name="job_description" placeholder="Promjena naziva/formata na ... / Upis voznog parka ne radi... / Potrebno je kreirati modul za skladište..."></textarea>
                            <p class="mb-0"><em>Tip: ako se što bolje opiše traženo, lakše bude isto izvesti!</em></p>
                        </div>
                    </div>
                    <hr>
                    <h1 class="h6">Prioritet</h1>
                    <div class="row mb-2">
                        <div class="form-group col">
                            <label for="priority">Odaberi prioritet:</label>
                            <select class="form-select" aria-label="Default select example" name="priority">
                                <option value="1">Mali</option>
                                <option selected value="2">Srednji</option>
                                <option value="3">Visoko</option>
                            </select>
                        </div>
                    </div>                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('createNewTicketModal')">Zatvori</button>
                <button type="button" class="btn btn-primary" onclick="submitForm('createNewTicketForm')">Save changes</button>
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