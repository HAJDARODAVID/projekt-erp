<div>
    <a class="btn btn-success btn-sm" href="#" onclick="showModal('addNewAttendanceEntry')">NOVI ZAPIS</a>

    <!-- Modal -->
    <div class="modal" id="addNewAttendanceEntry" style="display:  @if (Session::has('errors')) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novi zapis prisutnosti radnika</h5>
            </div>
            <div class="modal-body">
                <form  id="addNewAttendanceEntryForm" method="POST" action="{{ route('hp_manuelAttendanceEntry') }}">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-2">
                                <label for="date">Datum zapisa:</label>
                                <input type="date" class="form-control @error('start_date')is-invalid @enderror" id="date" name="date">
                            </div>
                        </div>
                        <div class="col">
                            <br>
                            <button class="btn btn-primary">GO</button>
                            <button class="btn btn-warning">BO</button>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mb-2">
                        <label for="car_plates">Naziv kooperanta</label>
                        <select class="form-select form-select-sm mb-2">
                            <option value="0" selected>Odaberi gradilište</option>
                            @foreach($constSites as $conSite)
                                <option value="{{$conSite->id}}">{{$conSite->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="entryType" value="10">
                    <input type="hidden" name="worker" value="{{ $worker }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addNewAttendanceEntry')">ZATVORI</button>
                <button type="button" class="btn btn-primary" onclick="submitForm('addNewAttendanceEntryForm')">SPREMI</button>
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