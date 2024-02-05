<div>
    <button class="btn btn-primary btn-sm" onclick="event.preventDefault();showModal('updateCooperatorWorker-{{ $row->id }}')"><i class="bi bi-pencil-fill"></i></button>
    <button class="btn btn-danger btn-sm" onclick="event.preventDefault();document.getElementById('worker-{{ $row->id }}').submit();"><i class="bi bi-trash-fill"></i></button>

    <form id="worker-{{ $row->id }}" action="{{ route('hp_deactivateCooperatorWorker', $row->id) }}" method="POST">
        @csrf
        @method('PUT')
    </form>

    <!-- Modal -->
    <div class="modal" id="updateCooperatorWorker-{{ $row->id }}" style="display:  @if (Session::has('errors')) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Promjena informacija radnika</h5>
            </div>
            <div class="modal-body">
                <form  id="addNewCooperatorWorkerForm" method="POST" action="{{ route('hp_newCooperatorWorker') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-2">
                      <label for="car_plates">Ime</label>
                      <input type="text" class="form-control @error('firstName')is-invalid @enderror" id="firstName" name="firstName" value="{{ $row->firstName }}" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="car_plates">Prezime</label>
                        <input type="text" class="form-control @error('lastName')is-invalid @enderror" id="lastName" name="lastName" value="{{ $row->lastName }}" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('updateCooperatorWorker-{{ $row->id }}')">ZATVORI</button>
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