<div>
    <button class="btn btn-success btn-sm" onclick="showModal('addNewConstructionSiteModal')">NOVO GRADILITE</button>

    <!-- Modal -->
    <div class="modal" id="addNewConstructionSiteModal" style="display:  @if (Session::has('errors')) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo gradilište</h5>
            </div>
            <div class="modal-body">
                <form  id="addNewCarForm" method="POST" action="{{ route('hp_addCompanyCars') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-2">
                      <label for="car_plates">Naziv gradilišta</label>
                      <input type="text" class="form-control @error('car_plates')is-invalid @enderror" id="car_plates" name="car_plates" placeholder="VŽ-999-HP" required>
                    </div>
                    <h1 class="h6 mt-3">Adresa</h1>
                    <div class="row mb-2">
                        <div class="form-group col">
                            <label for="brand">Ulica</label>
                            <input type="text" class="form-control @error('brand')is-invalid @enderror" id="brand" name="brand" placeholder="Peugeot">
                        </div>
                        <div class="form-group col">
                            <label for="model">Mjesto</label>
                            <input type="text" class="form-control @error('model')is-invalid @enderror" id="model"  name="model" placeholder="Boxer 2.2 HDi">
                        </div>
                    </div>
                    <h1 class="h6 mt-3">Vremenski period radova</h1>
                    <div class="row mb-2">
                        <div class="form-group col">
                            <label for="valid_to">Planirani početak radova</label>
                            <input type="date" class="form-control @error('valid_to')is-invalid @enderror" id="valid_to" name="valid_to" placeholder="Boxer 2.2 HDi">
                        </div>
                        <div class="form-group col">
                            <label for="valid_to">Planirani završetak radova</label>
                            <input type="date" class="form-control @error('valid_to')is-invalid @enderror" id="valid_to" name="valid_to" placeholder="Boxer 2.2 HDi">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col">
                            <label for="brand">Opis poslova</label>
                            <textarea class="form-control" id="textAreaExample1" rows="4"></textarea>
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