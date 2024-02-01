<div>
    <button class="btn btn-success btn-sm" onclick="showModal('addNewConstructionSiteModal')">NOVO GRADILIŠTE</button>

    <!-- Modal -->
    <div class="modal" id="addNewConstructionSiteModal" style="display:  @if (Session::has('errors')) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo gradilište</h5>
            </div>
            <div class="modal-body">
                <form  id="addNewCarForm" method="POST" action="{{ route('hp_addNewConstructionSites') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-2">
                      <label for="name">Naziv gradilišta</label>
                      <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" placeholder="Mimara" required>
                    </div>
                    <hr>
                    <h1 class="h6">Adresa</h1>
                    <div class="row mb-2">
                        <div class="form-group col">
                            <label for="street">Ulica</label>
                            <input type="text" class="form-control @error('street')is-invalid @enderror" id="street" name="street" placeholder="">
                        </div>
                        <div class="form-group col">
                            <label for="town">Mjesto</label>
                            <input type="text" class="form-control @error('town')is-invalid @enderror" id="town"  name="town" placeholder="">
                        </div>
                    </div>
                    <hr>
                    <h1 class="h6">Vremenski period radova</h1>
                    <div class="row mb-2">
                        <div class="form-group col">
                            <label for="start_date">Planirani početak radova</label>
                            <input type="date" class="form-control @error('start_date')is-invalid @enderror" id="start_date" name="start_date">
                        </div>
                        <div class="form-group col">
                            <label for="end_date">Planirani završetak radova</label>
                            <input type="date" class="form-control @error('end_date')is-invalid @enderror" id="end_date" name="end_date">
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="form-group col">
                            <label for="job_description">Opis poslova</label>
                            <textarea class="form-control @error('job_description')is-invalid @enderror" id="job_description" rows="4" name="job_description"></textarea>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addNewConstructionSiteModal')">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitForm('addNewCarForm')">Save changes</button>
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