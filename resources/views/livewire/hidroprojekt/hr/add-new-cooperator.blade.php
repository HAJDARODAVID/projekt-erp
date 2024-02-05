<div>
    <a class="btn btn-success btn-sm" href="#" onclick="showModal('addNewCooperator')">NOVI KOOPERANT</a>

    <!-- Modal -->
    <div class="modal" id="addNewCooperator" style="display:  @if (Session::has('errors')) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nova grupa kooperanta</h5>
            </div>
            <div class="modal-body">
                <form  id="addNewCooperatorForm" method="POST" action="{{ route('hp_newCooperators') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-2">
                      <label for="car_plates">Naziv kooperanta</label>
                      <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addNewCooperator')">ZATVORI</button>
                <button type="button" class="btn btn-primary" onclick="submitForm('addNewCooperatorForm')">SPREMI</button>
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
