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
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger" id="alert">
                        <p>Polja za ime i prezime moraju biti popunjena!</p>
                    </div>
                @endif
                <form  id="updateCooperatorWorkerForm-{{ $row->id }}" method="POST" action="{{ route('hp_updateCooperatorWorker', $row->id) }}">
                    @csrf
                    @method('PUT')
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
                <a type="button" class="btn btn-secondary" href="{{ route('hp_showCooperators', $row->cooperator_id) }}">ZATVORI</a>
                <button type="button" class="btn btn-primary" onclick="submitForm('updateCooperatorWorkerForm-{{ $row->id }}')">SPREMI</button>
            </div>
            </div>
        </div>
    </div>

    @if ($message = Session::get('error'))
        {{-- <div class="alert alert-success">
        <p>{{ $message['workerId'] }}</p>
        </div> --}}
        <script>showModal('updateCooperatorWorker-{{ $message['workerId'] }}')</script>
    @endif
    
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