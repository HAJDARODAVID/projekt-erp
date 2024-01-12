<div>
    <button class="btn btn-success btn-sm" onclick="showModal('addNewCarModal')">NOVO VOZILO</button>

    <!-- Modal -->
    <div class="modal" id="addNewCarModal" style="display:  @if (Session::has('errors')) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo vozilo</h5>
            </div>
            <div class="modal-body">
                <form  id="addNewCarForm" method="POST" action="{{ route('hp_addCompanyCars') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-2">
                      <label for="car_plates">Registracijske oznake</label>
                      <input type="text" class="form-control @error('car_plates')is-invalid @enderror" id="car_plates" name="car_plates" placeholder="VŽ-999-HP" required>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col">
                            <label for="brand">Marka</label>
                            <input type="text" class="form-control @error('brand')is-invalid @enderror" id="brand" name="brand" placeholder="Peugeot">
                        </div>
                        <div class="form-group col">
                            <label for="model">Model</label>
                            <input type="text" class="form-control @error('model')is-invalid @enderror" id="model"  name="model" placeholder="Boxer 2.2 HDi">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="brand">Godište</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Odaberi godište</option>
                                @for ($i=1985; $i<2036; $i++ )
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="valid_to">Registriran do</label>
                            <input type="date" class="form-control @error('valid_to')is-invalid @enderror" id="valid_to" name="valid_to" placeholder="Boxer 2.2 HDi">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addNewCarModal')">Close</button>
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