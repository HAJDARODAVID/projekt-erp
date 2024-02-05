<div>
    <a class="btn btn-success btn-sm" href="#" onclick="showModal('addNewCooperatorWorker')">NOVI RADNIK</a>

    <!-- Modal -->
    <div class="modal" id="addNewCooperatorWorker" style="display:  @if (Session::has('errors')) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novi radnik</h5>
            </div>
            <div class="modal-body">
                <form  id="addNewCooperatorWorkerForm" method="POST" action="{{ route('hp_newCooperatorWorker') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-2">
                      <label for="car_plates">Ime</label>
                      <input type="text" class="form-control @error('firstName')is-invalid @enderror" id="firstName" name="firstName" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="car_plates">Prezime</label>
                        <input type="text" class="form-control @error('lastName')is-invalid @enderror" id="lastName" name="lastName" required>
                    </div>
                    <input type="hidden" name="cooperator_id" value="{{ $cooperatorId }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addNewCooperatorWorker')">ZATVORI</button>
                <button type="button" class="btn btn-primary" onclick="submitForm('addNewCooperatorWorkerForm')">SPREMI</button>
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